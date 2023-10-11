<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrolment;
use App\InstructorCourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InstructorCourseController extends Controller
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
                return InstructorCourse::all();
            case 'instructor':
                $courses = $user->info->courses;
                $instructorcourses = [];
                foreach ($courses as $course) {
                    $instructorcourses[] = $course->instructorCourse;
                }
                return $instructorcourses;
            case 'student':
                $instructorcourses = [];
                foreach ($user->info->instructorCourses as $instructorcourse) {
                    $instructorcourses[] = $instructorcourse->makeHidden('chats', 'ratings')->append(['total_ratings', 'rating']);
                }
                return $instructorcourses;
            default:
                'default';
                break;
        }
    }

    public function students(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'instructor':

            case 'student':
                return InstructorCourse::find(request('instructorcourseid'))->students;

            default:
                'default';
                break;
        }
    }

    public function courseInstructors()
    {
        /*return DB::table('instructor_courses')
            ->join('instructors', 'instructor_courses.instructorid', '=', 'instructors.infoid')
            ->join('courses', 'instructor_courses.courseid', '=', 'courses.courseid')
            ->select('instructor_courses.instructorcourseid', 'instructors.profilepicurl','instructors.title', 'instructors.firstname', 'instructors.lastname', 'instructors.othername', 'instructors.edubackground', 'instructors.about','courses.description', 'instructor_courses.total_ratings', 'instructor_courses.rating')
            ->where('courses.coursepath', request('coursepath'))
            ->get();*/

        $courses = Course::all();
        $instructorcourses_with = [];
        foreach ($courses as $course) {
            if (strtolower($course->coursepath) == strtolower(request('coursepath'))) {
                $instructorcourse = InstructorCourse::with(['course', 'instructor'])->where('courseid', $course->courseid)->first();
                $instructorcourses_with[] = $instructorcourse;
            }
        }
        if (count($instructorcourses_with) > 0) {
            return response()->json(array(
                'course_instructors' => $instructorcourses_with
            ));
        }
        return response()->json(array(
            'course_exists' => false
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instructorcourseid = Str::uuid();
        InstructorCourse::forceCreate(
            ['instructorcourseid' => $instructorcourseid] +
            $request->all());

        $instructorcourse = InstructorCourse::where('instructorcourseid', $instructorcourseid)->first();

        return response()->json($instructorcourse);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstructorCourse  $instructorcourse
     * @return \Illuminate\Http\Response
     */
    public function show($instructorcourseid)
    {
        $instructorcourse = InstructorCourse::where('instructorcourseid', $instructorcourseid)->first();

        return response()->json($instructorcourse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstructorCourse  $instructorcourse
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorCourse $instructorcourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstructorCourse  $instructorcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstructorCourse $instructorcourse)
    {
        $instructorcourse->update($request->all());

        $updated_instructorcourse = InstructorCourse::where('instructorcourseid', $instructorcourse->instructorcourseid)->first();

        return response()->json($updated_instructorcourse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstructorCourse  $instructorcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstructorCourse $instructorcourse)
    {
        //
    }
}
