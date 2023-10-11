<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Enrolment;
use App\Payment;
use App\Period;
use App\Student;
use App\Timetable;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/

    public function login(Request $request)
    {

        $user = User::where('email', request('email'))->first();

        if (!$user) {
            if (request('external_login')) {
                $userid = Str::uuid();
                $user = User::forceCreate([
                    'userid' => $userid,
                    'email' => request('email'),
                    'password' => Hash::make(request('password')),
                    'role' => 'student',
                    'api_token' => Str::uuid(),
                    'email_verified' => 1,
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
                return $this->sendAll($request, $user);
            }
            return response()->json(array(
                'user_not_found' => true
            ));
        } else {
            if ($user->role == 'instructor') {
                return response()->json(array(
                    'linked_to_instructor_account' => true
                ));
            } elseif (request('external_login')) {
                return $this->sendAll($request, $user);
            } elseif (!$user->email_verified) {
                return response()->json(array(
                    'email_not_verified' => true
                ));
            } elseif (Hash::check(request('password'), $user->password)) {
                return $this->sendAll($request, $user);
            } else {
                return response()->json(array(
                    'incorrect_password' => true
                ));
            }
        }
    }

    private function sendAll(Request $request, $user): \Illuminate\Http\JsonResponse
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

        $user->update(
            [
                'guid' => request('guid'),
                'apphash' => request('apphash'),
                'osversion' => request('osversion'),
                'sdkversion' => request('sdkversion'),
                'device' => request('device'),
                'devicemodel' => request('devicemodel'),
                'deviceproduct' => request('deviceproduct'),
                'manufacturer' => request('manufacturer'),
                'androidid' => request('androidid'),
                'versionrelease' => request('versionrelease'),
                'deviceheight' => request('deviceheight'),
                'devicewidth' => request('devicewidth')
            ]
        );
        return Response::json(array(
            'successful' => true, // Successful
            'userid' => $user->userid,
            'api_token' => $user->api_token,
            'connected' => 1,

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
}
