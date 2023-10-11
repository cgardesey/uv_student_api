<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Course;
use App\Enrolment;
use App\EnrolmentRequest;
use App\InstitutionFee;
use App\Instructor;
use App\InstructorCourse;
use App\Institution;
use App\Payment;
use App\SubmittedAssignment;
use App\Timetable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class EnrolmentController extends Controller
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
                return Enrolment::all();
            case 'student':
                $instructorCourses = $user->info->instructorCourses;
                $enrolments = [];
                $instructor_course_student_arrays = [];
                foreach ($instructorCourses as $instructorCourse) {
                    $instructor_course_student_arrays[] = $instructorCourse->students;
                }
                foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
                    foreach ($instructor_course_student_array as $instructor_course_student) {
                        if ($instructor_course_student->enrolment->enrolled == 1) {
                            $enrolments[] = $instructor_course_student->enrolment;
                        }
                    }
                }
                return collect($enrolments)->unique('enrolmentid')->values()->all();

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
        $enrolment = Enrolment::where('studentid', request('studentid'))->where('instructorcourseid', request('instructorcourseid'))->first();
        $instructorCourse = InstructorCourse::where('instructorcourseid', request('instructorcourseid'))->first();
        $user = User::where('userid', $instructorCourse->instructorid)->first();
        $instructor = Instructor::where('infoid', $instructorCourse->instructorid)->first();
        $course = Course::where('courseid', $instructorCourse->courseid)->first();
        $timetables = Timetable::where('instructorcourseid', request('instructorcourseid'))->get();
        $audios = Audio::where('instructorcourseid', request('instructorcourseid'))->get();
        $institution = null;
        if ($instructorCourse->institutionid != null && $instructorCourse->institutionid != "") {
            $institution = Institution::where('institutionid', $instructorCourse->institutionid)->first();
        }
        $number_enrolled = 0;
        $max_courses = 0;
        if ($institution != null && $institution->internalinstitution) {
            $number_enrolled = DB::table('enrolments')
                ->join('instructor_courses', 'enrolments.instructorcourseid', '=', 'instructor_courses.instructorcourseid')
                ->join('institutions', 'instructor_courses.institutionid', '=', 'institutions.institutionid')
                ->select('institutions.internalinstitution')
                ->where('enrolments.studentid', '=', request('studentid'))
                ->where('enrolled', '=', 1)
                ->count();

            $feetype = Payment::where('institutionid', '=', $institution->institutionid)
                ->where("payerid", User::where('api_token', '=', $request->bearerToken())->first()->userid)
                ->latest('created_at')
                ->whereNotNull('feetype')
                ->first()
                ->feetype;
            $max_courses = explode('_', $feetype)[0];

            $institution_fees  = InstitutionFee::where('institutionid', '=', $institution->institutionid)->get();

            if ($number_enrolled == $max_courses) {
                if ($number_enrolled == 8) {
                    return Response::json(array(
                        'max_limit_reached' => true
                    ));
                }
                return Response::json(array(
                    'limit_reached' => true,
                    'institution_name' => $institution->name,
                    'institutionid' => $institution->institutionid,
                    'institution_fees' => $institution_fees,
                ));
            }
        }

        if (!$enrolment) {
            $enrolmentid = Str::uuid();
            Enrolment::forceCreate(
                [
                    'enrolmentid' => $enrolmentid,
                    'studentid' => request('studentid'),
                    'instructorcourseid' => request('instructorcourseid'),
                    'enrolled' => 1
                ]
            );

            $enrolment = Enrolment::find($enrolmentid);

            return Response::json(array(
                'instructorCourse' => $instructorCourse,
                'institution' => $institution,
                'remaining_courses' => $max_courses - ($number_enrolled + 1),
                'enrolment' => $enrolment,
                'course' => $course,
                'user' => $user,
                'instructor' => $instructor,
                'timetables' => $timetables,
                'audios' => $audios
            ));
        } else {
            if ($enrolment->enrolled) {
                return response()->json(array(
                    'already_enrolled' => 1
                ));
            }
            $enrolment->update(['enrolled' => true]);
            $updated_enrolment = Enrolment::where('enrolmentid', $enrolment->enrolmentid)->first();
            return Response::json(array(
                'instructorCourse' => $instructorCourse,
                'institution' => $institution,
                'remaining_courses' => $max_courses - ($number_enrolled + 1),
                'enrolment' => $updated_enrolment,
                'course' => $course,
                'user' => $user,
                'instructor' => $instructor,
                'timetables' => $timetables,
                'audios' => $audios
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Enrolment $enrolment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrolment $enrolment)
    {
        return $enrolment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Enrolment $enrolment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrolment $enrolment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Enrolment $enrolment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrolment $enrolment)
    {
        $enrolment->update($request->all());

        $updated_enrolment = Enrolment::where('enrolmentid', $enrolment->enrolmentid)->first();

        return response()->json($updated_enrolment);
    }

    public function bulkUnenrol(Request $request)
    {
        $i = 0;
        $enrolments = [];
        while($request->has("enrolmentid" . $i)) {
            $enrolment = Enrolment::where('enrolmentid', request("enrolmentid" . $i))->first();
            $enrolment->update(['enrolled' => 0]);
            $enrolments[] = Enrolment::where('enrolmentid', request("enrolmentid" . $i))->first();
            $i++;
        }
        return $enrolments;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Enrolment $enrolment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrolment $enrolment)
    {
        //
    }
}
