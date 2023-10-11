<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrolment;
use App\Institution;
use App\InstitutionFee;
use App\InstructorCourse;
use App\Payment;
use App\SubscriptionChangeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CourseController extends Controller
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
                return Course::all();
            case 'instructor':
                return $user->info->courses;
            case 'student':
//                return Course::setEagerLoads([])->get();
                $instructor_courses = $user->info->instructorCourses;
                $courses = [];
                foreach ($instructor_courses as $instructor_course) {
                    $courses[] = $instructor_course->course;
                }
                return $courses;
            default:
                'default';
                break;
        }
    }

    public function filteredCourses()
    {
        /*$courses = DB::table('courses')
            ->select('courseid', 'coursepath', 'description', 'institutionid')
            ->where('coursepath', 'LIKE', '%' . $search . '%');


        return DB::table('institutions')
            ->joinSub($courses, 'filtered_courses', function ($join) {
                $join->on('institutions.institutionid', '=', 'filtered_courses.institutionid');
            })
            ->paginate($perPage, ['filtered_courses.courseid', 'coursepath', 'name', 'description', 'logo'], null, $page)
            ->items();*/
        $course_paths = Course::where('coursepath', 'LIKE', '%' . request('search') . '%')
            ->where('coursepath', 'LIKE', '%' . ' >> Other >> ' . '%')
            ->pluck('coursepath')->toArray();

        /*$course_paths_2 = Course::where('coursepath', 'LIKE', '%' . request('search') . '%')
            ->where('coursepath', 'LIKE', '%' . ' >> School Direct Top SHS >> ' . '%')
            ->pluck('coursepath')->toArray();

        $course_paths = array_merge($course_paths, $course_paths_2);*/

//        $course_paths = Course::whereRaw("UPPER('coursepath') LIKE '%'". strtoupper(request('search'))."'%'")->pluck('coursepath')->toArray();

        $course_paths = array_slice($course_paths, request('offset'), request('length'));
        $course_paths_ucw = [];
        foreach ($course_paths as $course_path) {
            $course_paths_ucw[] = ucfirst(strtolower($course_path));
        }
        return array_merge(array_unique($course_paths_ucw), array());
    }

    public function subCourses()
    {
        $search = request('search');
        $course_paths = Course::where('coursepath', 'LIKE', '%' . $search . '%')->pluck('coursepath')->toArray();
//        $course_paths = Course::whereRaw("UPPER('coursepath') LIKE '%'". strtoupper($search)."'%'")->toArray();

        for ($i = 0; $i <= sizeof($course_paths) - 1; $i++) {
            $course_paths[$i] = preg_replace("/$search/", '', $course_paths[$i], 1);
            if (strpos($course_paths[$i], ' >> ') !== false) {
                $course_paths[$i] = substr_replace($course_paths[$i], "", strpos($course_paths[$i], " >> "));
            }
            $course_paths[$i] = trim($course_paths[$i]);
        }
        if (sizeof(explode(" >> ", $search)) == 2 && explode(" >> ", $search)[1] != "Other >>"){
            $courseid = Course::where('coursepath', 'LIKE', '%' . $search . '%')->first()->courseid;
            $institutionid = InstructorCourse::where('courseid', '=', $courseid)->first()->institutionid;
            $institution = Institution::find($institutionid);
            if ($institution->internalinstitution == 1) {
                $latest_payment = Payment::where('institutionid', '=', $institutionid)
                    ->where('payerid', '=', request('userid'))
                    ->whereNotNull('institutionfeeexpirydate')
                    ->latest('created_at')
                    ->first();

                $institution_fees = InstitutionFee::where('institutionid', '=', $institutionid)->get();


                $institutionfeeexpired = $latest_payment ? $latest_payment->institutionfeeexpired : true;

                if ($institutionfeeexpired) {
                    if (!$latest_payment) {
                        return response()->json(array(
                            'course_paths' => array_merge(array_unique($course_paths), array()),
                            'institution' => $institution,
                            'institution_fees' => $institution_fees
                        ));
                    }

                    //update pending payment status
                    if ($latest_payment->status == 'ACCEPTED' || $latest_payment->status == 'PENDING') {
                        //Check status
                        $curl = curl_init();
                        $momo_api_client_id = env("MOMO_API_CLIENT_ID");
                        $momo_api_client_password = env("MOMO_API_CLIENT_PASSWORD");
                        $pending_payment_token = hash('sha512', $latest_payment->paymentid . $momo_api_client_id . $momo_api_client_password);
                        $MOMO_API_BASE_URL = env("MOMO_API_BASE_URL");
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "{$MOMO_API_BASE_URL}transactionstatus",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "{\"header\": {\"clientid\": \"uvstudent\",\"countrycode\": \"{$latest_payment->countrycode}\",\"requestid\": \"{$latest_payment->paymentid}\",\"token\": \"{$pending_payment_token}\"},\"requesttype\": \"DEBIT\",\"paymentref\": \"{$latest_payment->paymentref}\"}",
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/json"
                            ),
                        ));

                        $status_response = curl_exec($curl);

                        Log::info('status_response', [
                            'status_response_institution' => $status_response
                        ]);

                        curl_close($curl);
                        //end status check
                        if ($status_response == "{}") {
                            return response()->json(array(
                                'course_paths' => array_merge(array_unique($course_paths), array()),
                                'pending_payment' => true,
                                'institution' => $institution
                            ));
                        }
                        $decoded_response = json_decode($status_response);

                        if ($decoded_response->header->message == 'SUCCESS' && $decoded_response->header->status == '000') {
                            $aupdate_arr = ['status' => $decoded_response->transactionstatus];
                            if (isset($decoded_response->transactionstatusreason)) {
                                $aupdate_arr + ['transactionstatusreason' => $decoded_response->transactionstatusreason];
                            }
                            $latest_payment->update(
                                $aupdate_arr
                            );
                            $latest_payment = Payment::find($latest_payment->paymentid);
                        }
                    }

                    if ($latest_payment->status == 'ACCEPTED' || $latest_payment->status == 'PENDING') {
                        return response()->json(array(
                            'course_paths' => array_merge(array_unique($course_paths), array()),
                            'pending_payment' => true,
                            'institution' => $institution
                        ));
                    }
                    else {
                        $subscription_change_request = SubscriptionChangeRequest::where('institutionid', '=', $institutionid)
                            ->where('studentid', '=', request('userid'))
                            ->latest('created_at')
                            ->first();

                        return response()->json(array(
                            'course_paths' => array_merge(array_unique($course_paths), array()),
                            'institution' => $institution,
                            'institution_fees' => $institution_fees,
                            'updated_payment' => $latest_payment,
//                            'subscription_change_request_approved' => $subscription_change_request ? $subscription_change_request->approved : 0
                            'subscription_change_request_approved' => 1
                        ));
                    }
                }

                return response()->json(array(
                    'course_paths' => array_merge(array_unique($course_paths), array()),
                    'institution' => $institution
                ));
            }
            return response()->json(array(
                'course_paths' => array_merge(array_unique($course_paths), array()),
                'institution' => $institution
            ));
        }

        return response()->json(array(
            'course_paths' => array_merge(array_unique($course_paths), array())
        ));
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
        $courseid = Str::uuid();
        Course::forceCreate(
            ['courseid' => $courseid] +
            $request->all());

        $course = course::where('courseid', $courseid)->first();

        return response()->json($course);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return $course;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->update($request->all());

        $updated_course = Course::where('courseid', $course->courseid)->first();

        return response()->json($updated_course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
