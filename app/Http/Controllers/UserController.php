<?php

namespace App\Http\Controllers;

use App\Enrolment;
use App\Instructor;
use App\InstructorCourse;
use App\AppUserFee;
use App\Payment;
use App\Period;
use App\Student;
use App\StudentProjectInfo;
use App\Timetable;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class UserController extends Controller
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
                return User::all();
            case 'student':
                $instructorCourses = $user->info->instructorCourses;
                $users = [];
                $users[] = $user;
                $instructor_course_student_arrays = [];
                foreach ($instructorCourses as $instructorCourse) {
                    $users[] = User::find($instructorCourse->instructor->infoid);
                    $instructor_course_student_arrays[] = $instructorCourse->students;
                }
                foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
                    foreach ($instructor_course_student_array as $instructor_course_student) {
                        $users[] = $instructor_course_student->user;
                    }
                }
                return collect($users)->unique('userid')->values()->all();
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
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request `
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $phonenumber = request('phonenumber');

        $user = User::where('phonenumber', '=', $phonenumber)->first();

        if (!$user) {
            $userid = Str::uuid();
            $user = User::forceCreate(
                [
                    'userid' => $userid,
                    'api_token' => Str::uuid(),
                    'connected' => false,
                ] +
                $request->all());

            Student::forceCreate([
                'infoid' => $userid
            ]);
        } else {
            $student = Student::find($user->userid);
            if (!$student) {
                Student::forceCreate([
                    'infoid' => $user->userid
                ]);
            }

            $user->update([
                'role' => 'student'
            ]);
            $user = User::where('phonenumber', $phonenumber)->first();
        }

        return $user;
    }

    public function confirmRegistration(Request $request)
    {
        $phonenumber = request('phonenumber');
        $user = User::where('phonenumber', $phonenumber)->first();
        $connected = $user->connected;
        $user->update([
            'connected' => false
        ]);

        if (true) {
//        if ($connected) {
            $client_whitelist = new Client();
            $CALL_API_BASE_URL = env("CALL_API_BASE_URL");
            $response = $client_whitelist->createRequest(
                "GET",
                "{$CALL_API_BASE_URL}api/v1/student/{$phonenumber}/true"
            );
            $whitelist_response = $client_whitelist->send($response)->getBody();
            Log::info('whitelist_response', [
                'whitelist_response' => $whitelist_response->getContents()
            ]);
            return $this->sendAll($user);
        } else {
            return response()->json(array(
                'connected' => 0,
            ));
        }
    }

    public function versionGuidCheck(Request $request)
    {
        return response()->json(array(
            'version' => StudentProjectInfo::first()->version,
            'guid' => User::where('api_token', '=', $request->bearerToken())->first()->guid
        ));
    }

    public function sendOtp()
    {
        $phonenumber = request('phonenumber');

        $user = User::where('phonenumber', $phonenumber)->first();

        $already_registered = false;
        if (!$user) {
            $already_registered = false;
            $userid = Str::uuid();
            $user = User::forceCreate([
                'userid' => $userid,
                'phonenumber' => $phonenumber,
                'role' => request('role'),
                'api_token' => Str::uuid()
            ]);
            if ($user->role == 'student') {
                Student::forceCreate([
                    'infoid' => $userid
                ]);
            } else if ($user->role == 'instructor') {
                Instructor::forceCreate([
                    'infoid' => $userid
                ]);
            }
        } else {
            $already_registered = true;
        }
        $hash = request('hash');
        $client = new Client();
        $otp = mt_rand(1000, 9999);
        $content = "<#> Your OTP is: $otp $hash";
        $content = urlencode($content);

        $user->update([
            'otp' => $otp
        ]);

        $CLICKATELL_API_KEY = env("CLICKATELL_API_KEY");
        $response = $client->createRequest(
            "GET",
            "https://platform.clickatell.com/messages/http/send?apiKey={$CLICKATELL_API_KEY}&to=$phonenumber&content=$content"
        );
        $contents = $client->send($response)->getBody()->getContents();
//        return $contents;
        return response()->json(array(
            'contents' => $contents,
            'userid' => $user->userid,
            'api_token' => $user->api_token,
            'already_registered' => $already_registered,
        ));
    }

    public function getOtp(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $otp = $user->otp;
        $user->update(['otp' => null]);
        return $otp;
    }

    public function generatePin(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();

        $pin = mt_rand(1000, 9999);

        $user->update([
            'username' => $user->info->firstname,
            'password' => Hash::make($pin)
        ]);

        return response()->json(array(
            'pin' => $pin
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        $updated_user = User::where('userid', $user->userid)->first();

        return response()->json($updated_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function fetchAll(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'student':

                return $this->sendAll($user);

            default:
                'default';
                break;
        }
    }

    public function fetchEnrolmentRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'student':

                return $this->sendAllEnrolmentRefreshData($user);

            default:
                'default';
                break;
        }
    }

    public function fetchAssignmentsRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'student':

                return $this->sendAllAssignmentsRefreshData($user);

            default:
                'default';
                break;
        }
    }

    public function fetchQuizzesRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'student':

                return $this->sendAllQuizzesRefreshData($user);

            default:
                'default';
                break;
        }
    }

    public function fetchLiveClassRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'student':

                $columntobeupdated = request("columntobeupdated");
                $instructorcourseid = request("instructorcourseid");
                $id = request("id");
                return $this->sendAllLiveClassRefreshData($user, $columntobeupdated, $instructorcourseid, $id);

            default:
                'default';
                break;
        }
    }

    public function fetchAttendanceRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;
        return $this->sendAllAttendanceRefreshData($user);
    }

    /**
     * @param $user
     * @param array $payment_arrays
     * @param array $users
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendAll($user): \Illuminate\Http\JsonResponse
    {
        /*// fetch assignments
        $instructorcourses = $user->info->instructorCourses;
        $assignments = [];
        $instructor_course_assignments_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_assignments_arrays[] = $instructorcourse->assignments;
        }
        foreach ($instructor_course_assignments_arrays as $instructor_course_assignments_array) {
            foreach ($instructor_course_assignments_array as $instructor_course_assignment) {
                $assignments[] = $instructor_course_assignment;
            }
        }*/

        /*// fetch attendances
        $attendances = $user->info->attendances;


        // fetch audios
        $audios = [];
        $instructor_course_audios_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_audios_arrays[] = $instructorcourse->audios;
        }
        foreach ($instructor_course_audios_arrays as $instructor_course_audios_array) {
            foreach ($instructor_course_audios_array as $instructor_course_audio) {
                $audios[] = $instructor_course_audio;
            }
        }*/


        /* // fetch chats
         $chats = [];
         $instructor_course_chat_arrays = [];
         foreach ($instructorcourses as $instructorcourse) {
             $instructor_course_chat_arrays[] = $instructorcourse->chats;
         }
         foreach ($instructor_course_chat_arrays as $instructor_course_chat_array) {
             foreach ($instructor_course_chat_array as $instructor_course_chat) {
                 $chats[] = $instructor_course_chat;
             }
         }*/


        // fetch courses
        $instructor_courses = $user->info->instructorCourses;
        $courses = [];
        foreach ($instructor_courses as $instructor_course) {
            $courses[] = $instructor_course->course;
        }


        // fetch enrolments
        $instructorCourses = $user->info->instructorCourses;
        $enrolments = [];
        $instructor_course_student_arrays = [];
        foreach ($instructorCourses as $instructorCourse) {
            $instructor_course_student_arrays[] = $instructorCourse->students;
        }
        foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
            foreach ($instructor_course_student_array as $instructor_course_student) {
                $enrolments[] = $instructor_course_student->enrolment;
            }
        }
        $enrolments = collect($enrolments)->unique('enrolmentid')->values()->all();


        // fetch instructors
        $instructor_courses = $user->info->instructorCourses;
        $instructors = [];
        foreach ($instructor_courses as $instructor_course) {
            $instructors[] = $instructor_course->instructor;
        }


        // fetch instructor-courses
        $instructorcourses = $user->info->instructorCourses;

        // fetch payments
        Payment::whereNull('paymentref')->delete();
        $payments = Payment::where('payerid', '=', $user->userid)->get();

        //fetch institutions
        $instructorcourses = $user->info->instructorCourses;
        $institutions = [];
        foreach ($instructorcourses as $instructorcourse) {
            $institution = $instructorcourse->institution;
            if ($institution) {
                $institutions[] = $institution;
            }
        }

        // fetch students
        $instructorCourses = $user->info->instructorCourses;
        $students = [];
        $students[] = $user->info;
        $instructor_course_student_arrays = [];
        foreach ($instructorCourses as $instructorCourse) {
            $instructor_course_student_arrays[] = $instructorCourse->students;
        }
        foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
            foreach ($instructor_course_student_array as $instructor_course_student) {
                $students[] = $instructor_course_student;
            }
        }
        $students = collect($students)->unique('infoid')->values()->all();


        /*// fetch submitted-assignments
        $submitted_assignments = $user->info->submittedAssignments;*/

        /*// fetch submitted-quizzes
        $submitted_quizzes = $user->info->submittedQuizzes;*/

        // fetch users
        $instructorCourses = $user->info->instructorCourses;
        $users = [];
        $instructor_course_student_arrays = [];
        foreach ($instructorCourses as $instructorCourse) {
            $users[] = User::find($instructorCourse->instructor->infoid);
            $instructor_course_student_arrays[] = $instructorCourse->students;
        }
        foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
            foreach ($instructor_course_student_array as $instructor_course_student) {
                $users[] = $instructor_course_student->user;
            }
        }
        $users = collect($users)->unique('userid')->values()->all();


        // fetch periods
        $periods = Period::all();


        // fetch timetables
        $instructor_courses = $user->info->instructorCourses;
        $timetables = [];
        $timetables_arrays = [];
        foreach ($instructor_courses as $instructor_course) {
            $timetables_arrays[] = Timetable::where('instructorcourseid', $instructor_course->instructorcourseid)->get();
        }
        foreach ($timetables_arrays as $timetables_array) {
            foreach ($timetables_array as $timetable) {
                $timetables[] = $timetable;
            }
        }


        /*// fetch instructor-course-ratings
        $instructor_courses = $user->info->instructorCourses;
        $instructor_course_ratings = [];
        $instructor_course_rating_arrays = [];
        foreach ($instructor_courses as $instructor_course) {
            $instructor_course_rating_arrays[] = $instructor_course->ratings;
        }
        foreach ($instructor_course_rating_arrays as $instructor_course_rating_array) {
            foreach ($instructor_course_rating_array as $instructor_course_rating) {
                $instructor_course_ratings[] = $instructor_course_rating;
            }
        }*/

        /*// fetch quizzes
        $instructorcourses = $user->info->instructorCourses;
        $quizzes = [];
        $instructor_course_quizzes_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_quizzes_arrays[] = $instructorcourse->quizzes;
        }
        foreach ($instructor_course_quizzes_arrays as $instructor_course_quizzes_array) {
            foreach ($instructor_course_quizzes_array as $instructor_course_quiz) {
                $quizzes[] = $instructor_course_quiz;
            }
        }*/

        // fetch dialcodes
        $dialcodes = DB::table('dialcode')->get();

        /*// fetch videos
        $instructorcourses = $user->info->instructorCourses;
        $recorded_videos = [];
        $instructor_course_recorded_videos_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_videos_arrays[] = $instructorcourse->recordedVideos;
        }
        foreach ($instructor_course_recorded_videos_arrays as $instructor_course_recorded_videos_array) {
            foreach ($instructor_course_recorded_videos_array as $instructor_course_recorded_video) {
                $recorded_videos[] = $instructor_course_recorded_video;
            }
        }*/

        /*// fetch recorded-video-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_video_streams = [];
        $instructor_course_recorded_video_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_video_streams_arrays[] = $instructorcourse->recordedVideoStreams;
        }
        foreach ($instructor_course_recorded_video_streams_arrays as $instructor_course_recorded_video_streams_array) {
            foreach ($instructor_course_recorded_video_streams_array as $instructor_course_recorded_video_stream) {
                $recorded_video_streams[] = $instructor_course_recorded_video_stream;
            }
        }*/


        /*// fetch recorded-audio-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_audio_streams = [];
        $instructor_course_recorded_audio_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_audio_streams_arrays[] = $instructorcourse->recordedAudioStreams;
        }
        foreach ($instructor_course_recorded_audio_streams_arrays as $instructor_course_recorded_audio_streams_array) {
            foreach ($instructor_course_recorded_audio_streams_array as $instructor_course_recorded_audio_stream) {
                $recorded_audio_streams[] = $instructor_course_recorded_audio_stream;
            }
        }*/

        //fetch app-user-fees
        $app_user_fees = DB::table('app_user_fees')->get();

        // fetch drawing-coordinates
        /*$instructorcourses = $user->info->instructorCourses;
        $drawing_coordinates = [];
        $instructor_course_drawing_coordinates_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_drawing_coordinates_arrays[] = $instructorcourse->drawingCoordinates;
        }
        foreach ($instructor_course_drawing_coordinates_arrays as $instructor_course_drawing_coordinates_array) {
            foreach ($instructor_course_drawing_coordinates_array as $instructor_course_drawing_coordinate) {
                $drawing_coordinates[] = $instructor_course_drawing_coordinate;
            }
        }*/


        return Response::json(array(
            'userid' => $user->userid,
            'api_token' => $user->api_token,
            'connected' => 1,
//            'assignments' => $assignments,
//            'attendances' => $attendances,
//            'audios' => $audios,
//            'chats' => $chats,
            'courses' => $courses,
            'enrolments' => $enrolments,
            'instructors' => $instructors,
            'instructor_courses' => $instructor_courses,
            'payments' => $payments,
            'institutions' => $institutions,
            'students' => $students,
//            'submitted_assignments' => $submitted_assignments,
            'users' => $users,
            'periods' => $periods,
            'timetables' => $timetables,
//            'instructor_course_ratings' => $instructor_course_ratings,
//            'quizzes' => $quizzes,
//            'submitted_quizzes' => $submitted_quizzes,
            'dialcodes' => $dialcodes,
//            'recorded_videos' => $recorded_videos,
//            'recorded_video_streams' => $recorded_video_streams,
//            'recorded_audio_streams' => $recorded_audio_streams,
            'app_user_fees' => $app_user_fees,
//            'drawing_coordinates' => $drawing_coordinates
        ));
    }

    private function sendAllEnrolmentRefreshData($user): \Illuminate\Http\JsonResponse
    {
        $enrolments = Enrolment::with(['payments', 'instructorCourse.course', 'instructorCourse.instructor', 'instructorCourse.institution', 'instructorCourse.timetables'])->where('studentid', $user->userid)->where('enrolled', 1)->get();
        $instructor_courses = [];
        $instructors = [];
        $courses = [];
        $payments = [];
        $institutions = [];
        $students = [];
        $users = [];
        $timetables = [];

        foreach ($enrolments as $enrolment) {
            $instructor_courses[] = $enrolment->instructorCourse;
            $courses[] = $enrolment->instructorCourse->course;
            $instructors[] = $enrolment->instructorCourse->instructor;

            $institution = $enrolment->instructorCourse->institution;
            if ($institution) {
                $institutions[] = $institution;
            }
            $course_timetables = $enrolment->instructorCourse->timetables;
            foreach ($course_timetables as $timetable) {
                $timetables[] = $timetable;
            }

            $course_payments = $enrolment->payments;
            foreach ($course_payments as $payment) {
                $payments[] = $payment;
            }
        }
        $institutions = collect($institutions)->unique('institutionid')->values()->all();

        $users[] = $user;

        $students[] = $user->info;
        // fetch periods
        $periods = Period::all();

        // fetch dialcodes
        $dialcodes = DB::table('dialcode')->get();

        //fetch app-user-fees
        $app_user_fees = DB::table('app_user_fees')->get();

        return Response::json(array(
            'students' => $students,
            'users' => $users,
            'courses' => $courses,
            'enrolments' => $enrolments,
            'instructors' => $instructors,
            'instructor_courses' => $instructor_courses,
            'payments' => $payments,
            'institutions' => $institutions,
            'periods' => $periods,
            'timetables' => $timetables,
            'dialcodes' => $dialcodes,
            'app_user_fees' => $app_user_fees,
        ));
    }

    private function sendAllAssignmentsRefreshData($user): \Illuminate\Http\JsonResponse
    {
        // fetch assignments
        $instructorcourses = $user->info->instructorCourses;
        $assignments = [];
        $instructor_course_assignments_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_assignments_arrays[] = $instructorcourse->assignments;
        }
        foreach ($instructor_course_assignments_arrays as $instructor_course_assignments_array) {
            foreach ($instructor_course_assignments_array as $instructor_course_assignment) {
                $assignments[] = $instructor_course_assignment;
            }
        }

        // fetch submitted-assignments
        $submitted_assignments = $user->info->submittedAssignments;

        return Response::json(array(
            'assignments' => $assignments,
            'submitted_assignments' => $submitted_assignments
        ));
    }

    private function sendAllQuizzesRefreshData($user): \Illuminate\Http\JsonResponse
    {
        // fetch quizzes
        $instructorcourses = $user->info->instructorCourses;
        $quizzes = [];
        $instructor_course_quizzes_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_quizzes_arrays[] = $instructorcourse->quizzes;
        }
        foreach ($instructor_course_quizzes_arrays as $instructor_course_quizzes_array) {
            foreach ($instructor_course_quizzes_array as $instructor_course_quiz) {
                $quizzes[] = $instructor_course_quiz;
            }
        }

        // fetch submitted-quizzes
        $submitted_quizzes = $user->info->submittedQuizzes;

        return Response::json(array(
            'quizzes' => $quizzes,
            'submitted_quizzes' => $submitted_quizzes
        ));
    }

    private function sendAllLiveClassRefreshData($user, $columntobeupdated, $instructorcourseid, $id): \Illuminate\Http\JsonResponse
    {
        /*DB::table('enrolments')
            ->where('studentid', $user->userid)
            ->update([$columntobeupdated => 1]);*/
        $instructorCourse = InstructorCourse::with(['instructor', 'students'])->where('instructorcourseid', $instructorcourseid)->first();
        $instructor = $instructorCourse->instructor;
        // fetch instructor courses
        $instructor_courses[] = $instructorCourse;

        // fetch instructors
        $instructors[] = $instructor;

        // fetch students
        $students = $instructorCourse->students;

        // fetch users
        $users[] = User::find($instructor->infoid);
        foreach ($students as $student) {
            $users[] = $student->user;
        }

        $enrolments = [];
        // fetch enrolments
        foreach ($students as $student) {
            $enrolments[] = $student->enrolment;
        }

        //fetch chats
        $chats = DB::table('chats')
            ->where('instructorcourseid', $instructorcourseid)
            ->where('id', '>', $id)
            ->get();

        return Response::json(array(
            'users' => $users,
            'instructors' => $instructors,
            'students' => $students,
            'instructor_courses' => $instructor_courses,
            'enrolments' => $enrolments,
            'chats' => $chats
        ));
    }

    public function fetchRecordedStreamsRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        // fetch audios
        $instructorcourses = $user->info->instructorCourses;
        $audios = [];
        $instructor_course_audios_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_audios_arrays[] = $instructorcourse->audios;
        }
        foreach ($instructor_course_audios_arrays as $instructor_course_audios_array) {
            foreach ($instructor_course_audios_array as $instructor_course_audio) {
                $audios[] = $instructor_course_audio;
            }
        }

        // fetch recorded-video-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_video_streams = [];
        $instructor_course_recorded_video_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_video_streams_arrays[] = $instructorcourse->recordedVideoStreams;
        }
        foreach ($instructor_course_recorded_video_streams_arrays as $instructor_course_recorded_video_streams_array) {
            foreach ($instructor_course_recorded_video_streams_array as $instructor_course_recorded_video_stream) {
                $recorded_video_streams[] = $instructor_course_recorded_video_stream;
            }
        }


        // fetch recorded-audio-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_audio_streams = [];
        $instructor_course_recorded_audio_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_audio_streams_arrays[] = $instructorcourse->recordedAudioStreams;
        }
        foreach ($instructor_course_recorded_audio_streams_arrays as $instructor_course_recorded_audio_streams_array) {
            foreach ($instructor_course_recorded_audio_streams_array as $instructor_course_recorded_audio_stream) {
                $recorded_audio_streams[] = $instructor_course_recorded_audio_stream;
            }
        }

        return Response::json(array(
            'audios' => $audios,
            'recorded_video_streams' => $recorded_video_streams,
            'recorded_audio_streams' => $recorded_audio_streams,
        ));
    }

    public function fetchPaymentRefreshData(Request $request)
    {
        // fetch app user fee
        $app_user_fee = AppUserFee::first();

        // fetch instructor course
        $instructor_course = InstructorCourse::find(request('instructorcourseid'));

        // fetch enrolment
        $enrolment = Enrolment::find(request('enrolmentid'));

        return Response::json(array(
            'app_user_fee' => $app_user_fee,
            'instructor_course' => $instructor_course,
            'enrolment' => $enrolment
        ));
    }

    public function fetchDocsRefreshData(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();

        $instructorcourses = $user->info->instructorCourses;
        // fetch audios
        $audios = [];
        $instructor_course_audios_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_audios_arrays[] = $instructorcourse->audios;
        }
        foreach ($instructor_course_audios_arrays as $instructor_course_audios_array) {
            foreach ($instructor_course_audios_array as $instructor_course_audio) {
                $audios[] = $instructor_course_audio;
            }
        }

        // fetch recorded-video-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_video_streams = [];
        $instructor_course_recorded_video_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_video_streams_arrays[] = $instructorcourse->recordedVideoStreams;
        }
        foreach ($instructor_course_recorded_video_streams_arrays as $instructor_course_recorded_video_streams_array) {
            foreach ($instructor_course_recorded_video_streams_array as $instructor_course_recorded_video_stream) {
                $recorded_video_streams[] = $instructor_course_recorded_video_stream;
            }
        }


        // fetch recorded-audio-streams
        $instructorcourses = $user->info->instructorCourses;
        $recorded_audio_streams = [];
        $instructor_course_recorded_audio_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_audio_streams_arrays[] = $instructorcourse->recordedAudioStreams;
        }
        foreach ($instructor_course_recorded_audio_streams_arrays as $instructor_course_recorded_audio_streams_array) {
            foreach ($instructor_course_recorded_audio_streams_array as $instructor_course_recorded_audio_stream) {
                $recorded_audio_streams[] = $instructor_course_recorded_audio_stream;
            }
        }

        // fetch recorded-audio-streams
        $instructorcourses = $user->info->instructorCourses;
        $recommended_docs = [];
        $instructor_course_recommended_docs_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recommended_docs_arrays[] = $instructorcourse->recommendedDocs;
        }
        foreach ($instructor_course_recommended_docs_arrays as $instructor_course_recommended_docs_array) {
            foreach ($instructor_course_recommended_docs_array as $instructor_course_recomended_doc) {
                $recommended_docs[] = $instructor_course_recomended_doc;
            }
        }

        return Response::json(array(
            'audios' => $audios,
            'recorded_audio_strems' => $recorded_audio_streams,
            'recorded_video_strems' => $recorded_video_streams,
            'recommended_docs' => $recommended_docs,
        ));
    }

    private function sendAllAttendanceRefreshData($user): \Illuminate\Http\JsonResponse
    {
        // fetch attendances
        $attendances = $user->info->attendances;

        $instructorcourses = $user->info->instructorCourses;

        // fetch audios
        $audio = [];
        $instructor_course_audios_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_audios_arrays[] = $instructorcourse->audios;
        }
        foreach ($instructor_course_audios_arrays as $instructor_course_audios_array) {
            foreach ($instructor_course_audios_array as $instructor_course_audio) {
                $audios[] = $instructor_course_audio;
            }
        }

        // fetch recorded-video-streams
        $recorded_video_streams = [];
        $instructor_course_recorded_video_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_video_streams_arrays[] = $instructorcourse->recordedVideoStreams;
        }
        foreach ($instructor_course_recorded_video_streams_arrays as $instructor_course_recorded_video_streams_array) {
            foreach ($instructor_course_recorded_video_streams_array as $instructor_course_recorded_video_stream) {
                $recorded_video_streams[] = $instructor_course_recorded_video_stream;
            }
        }


        // fetch recorded-audio-streams
        $recorded_audio_streams = [];
        $instructor_course_recorded_audio_streams_arrays = [];
        foreach ($instructorcourses as $instructorcourse) {
            $instructor_course_recorded_audio_streams_arrays[] = $instructorcourse->recordedAudioStreams;
        }
        foreach ($instructor_course_recorded_audio_streams_arrays as $instructor_course_recorded_audio_streams_array) {
            foreach ($instructor_course_recorded_audio_streams_array as $instructor_course_recorded_audio_stream) {
                $recorded_audio_streams[] = $instructor_course_recorded_audio_stream;
            }
        }

        return Response::json(array(
            'attendances' => $attendances,
            'audio' => $audio,
            'recorded_audio_streams' => $recorded_audio_streams,
            'recorded_video_streams' => $recorded_video_streams
        ));
    }
}
