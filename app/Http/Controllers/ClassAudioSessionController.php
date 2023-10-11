<?php

namespace App\Http\Controllers;

use App\ClassAudioSession;
use App\Institution;
use App\InstructorCourse;
use App\Enrolment;
use App\Student;
use App\User;
use App\Payment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ClassAudioSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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

    }

    /**
     * Display the specified resource.
     *
     * @param \App\ClassAudioSession $classAudioSession
     * @return \Illuminate\Http\Response
     */
    public function getLiveAudioClass(Request $request)
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
        $class_audio_session = ClassAudioSession::where('instructorcourseid', '=', request('instructorcourseid'))->first();

        $eligible = false;
        if ($instructorcourse->institutionid != null && $instructorcourse->institutionid != "" && Institution::find($instructorcourse->institutionid)->internalinstitution == 1) {
            $eligible  = !$enrolment->institutionfeeexpired;
        }
        else {
            $eligible  = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        }

        if (!$class_audio_session) {
            return response()->json(array(
                'eligible' => $eligible,
                'intructorcourse' => $instructorcourse,
                'enrolment' => $enrolment,
                'class_audio_session' => $class_audio_session
            ));
        }

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

        $CALL_API_BASE_URL = env("CALL_API_BASE_URL");
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
            'class_audio_session' => $class_audio_session
        ));
    }

    public function classSessionRefreshData(Request $request)
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
        $class_audio_session = ClassAudioSession::where('instructorcourseid', '=', request('instructorcourseid'))->first();

        $session_changed = $class_audio_session->sessionid != request('sessionid');

        $eligible = false;
        if ($instructorcourse->institutionid != null && $instructorcourse->institutionid != "" && Institution::find($instructorcourse->institutionid)->internalinstitution == 1) {
            $eligible  = !$enrolment->institutionfeeexpired;
        }
        else {
            $eligible  = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        }

        if (!$session_changed) {
            return response()->json(array(
                'eligible' => $eligible,
                'intructorcourse' => $instructorcourse,
                'enrolment' => $enrolment,
                'session_changed' => false
            ));
        }

        $drawing_coordinates = DB::table('drawing_coordinates')->where('classsessionid', $class_audio_session->sessionid)->get();

        /*$process = new Process(['ffprobe', '-v', 'quiet', '-print_format', 'json', '-show_streams'  , $class_audio_session->streamurl]);
        $process->run();

        // executes after the command finishes
        if ($process->isSuccessful()) {
            return response()->json(array(
                'eligible' => $eligible,
                'intructorcourse' => $instructorcourse,
                'enrolment' => $enrolment,
                'session_changed' => true,
                'class_audio_session' => $class_audio_session,
                'drawing_coordinates' => $drawing_coordinates,
                'streaming' => true
            ));
        }*/

        return response()->json(array(
            'eligible' => $eligible,
            'intructorcourse' => $instructorcourse,
            'enrolment' => $enrolment,
            'session_changed' => true,
            'class_audio_session' => $class_audio_session,
            'drawing_coordinates' => $drawing_coordinates,
//            'streaming' => false
            'streaming' => true
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ClassAudioSession $classAudioSession
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassAudioSession $classAudioSession)

    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassAudioSession $classAudioSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassAudioSession $classAudioSession)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ClassAudioSession $classAudioSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassAudioSession $classAudioSession)
    {
        //
    }
}
