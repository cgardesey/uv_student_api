<?php

namespace App\Http\Controllers;

use App\ClassSession;
use App\Institution;
use App\InstructorCourse;
use App\Enrolment;
use App\User;
use App\Student;
use App\Payment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClassSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return ClassSession::all();
            case 'student':
                $classs = $user->info->classs;
                $class_sessions = [];
                $class_sessions_arrays = [];
                foreach ($classs as $class) {
                    $class_sessions_arrays[] = $class->sessions;
                }
                foreach ($class_sessions_arrays as $class_sessions_array) {
                    foreach ($class_sessions_array as $class_session) {
                        $class_sessions[] = $class_session->classSession;
                    }
                }
                return $class_sessions;
            default:
                'default';
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define folder path
        $folder = '/uploads/class-session-docs/';
        // Make a file name based on title and current timestamp
        $name = Str::slug($request->input('title')) . '_' . time();

        $i = 0;

        while ($request->hasFile("file" . $i)) {
            // Get image file
            $image = $request->file("file$i");
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . $i . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, '', $name . $i);/**/

            ClassSession::forceCreate(
                ['classsessionid' => Str::uuid()] +
                ['courseid' => $request->input('courseid')] +
                ['title' => $request->input('title')] +
                ['description' => $request->input('description')] +
                ['docurl' => $filePath] +
                ['roomid' => $request->input('assignmentid')]
            );
            $i++;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ClassSession $classsession
     * @return \Illuminate\Http\Response
     */
    public function getLiveClass(Request $request)
    {
        $latest_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('expirydate')
            ->first();

        $latest_appuserfee_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('appuserfeeexpirydate')
            ->first();

        $expired = $latest_payment ? $latest_payment->expired : true;
        $appuserfeeexpired = $latest_appuserfee_payment ? $latest_appuserfee_payment->appuserfeeexpired : true;

        $instructorcourse = InstructorCourse::find(request('instructorcourseid'));
        $enrolment = Enrolment::find(request('enrolmentid'));
        $classsession = ClassSession::where('instructorcourseid', '=', request('instructorcourseid'))->first();

        $eligible = false;
        if ($instructorcourse->institutionid != null && $instructorcourse->institutionid != "" && Institution::find($instructorcourse->institutionid)->internalinstitution == 1) {
            $eligible  = !$enrolment->institutionfeeexpired;
        }
        else {
            $eligible  = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        }

        if (!$classsession) {
            return response()->json(array(
                'eligible' => $eligible,
                'intructorcourse' => $instructorcourse,
                'enrolment' => $enrolment,
                'classsession' => $classsession
            ));
        }
        $client = new Client();
        $CALL_API_BASE_URL = env("CALL_API_BASE_URL");
        $response = $client->createRequest(
            "POST",
             $CALL_API_BASE_URL . 'v2/participant/status'
        );
        $participant_response = $client->send($response)->getBody();

        $phonenumber = request('mobileno');
        $client_whitelist = new Client();
        $eligibility = $eligible ? "true" : "false";

        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $student = Student::find($user->userid);

        $student->update(
            [
                'primarycontact' => $phonenumber
            ]
        );

        $curl = curl_init();

        $CALL_API_BASE_URL = $CALL_API_BASE_URL;
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . $CALL_API_BASE_URL . 'v2/participant/status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "{\"status\": \"$eligibility\",\"participant\": \"$phonenumber\"}",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json(array(
            'eligible' => $eligible,
            'intructorcourse' => $instructorcourse,
            'enrolment' => $enrolment,
//            'no_participants_exist' => Str::contains($participant_response->getContents(), 'No participants found for conference room'),
            'no_participants_exist' => false,
            'classsession' => $classsession
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ClassSession $classsession
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSession $classsession)

    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassSession $classsession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSession $classsession)
    {
        $classsession->update($request->all());

        $updated_classsession = ClassSession::where('classsessionid', $classsession->classsessionid)->first();

        return response()->json($updated_classsession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ClassSession $classsession
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSession $classsession)
    {
        //
    }
}
