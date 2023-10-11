<?php

namespace App\Http\Controllers;

use App\InstructorCoursePeriod;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstructorCoursePeriodController extends Controller
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
                return InstructorCoursePeriod::all();
            case 'student':
                $instructor_courses = $user->info->instructorCourses;
                $instructor_course_periods = [];
                $instructor_course_period_arrays = [];
                foreach ($instructor_courses as $instructor_course) {
                    $instructor_course_period_arrays[] = $instructor_course->periods;
                }
                foreach ($instructor_course_period_arrays as $instructor_course_period_array) {
                    foreach ($instructor_course_period_array as $instructor_course_period) {
                        $instructor_course_periods[] = $instructor_course_period;
                    }
                }
                return $instructor_course_periods;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instructorcourseperiodid = Str::uuid();
        InstructorCoursePeriod::forceCreate(
            ['instructorcourseperiodid' => $instructorcourseperiodid] +
            $request->all());

        $instructorCoursePeriod = InstructorCoursePeriod::where('instructorcourseperiodid', $instructorcourseperiodid)->first();

        return response()->json($instructorCoursePeriod);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\InstructorCoursePeriod  $instructorCoursePeriod
     * @return \Illuminate\Http\Response
     */
    public function show(InstructorCoursePeriod $instructorCoursePeriod)
    {
        return $instructorCoursePeriod;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstructorCoursePeriod  $instructorCoursePeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorCoursePeriod $instructorCoursePeriod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstructorCoursePeriod  $instructorCoursePeriod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstructorCoursePeriod $instructorCoursePeriod)
    {
        $instructorCoursePeriod->update($request->all());

        $updated_instructorCoursePeriod = InstructorCoursePeriod::where('instructorcourseperiodid', $instructorCoursePeriod->instructorcourseperiodid)->first();

        return response()->json($updated_instructorCoursePeriod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstructorCoursePeriod  $instructorCoursePeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstructorCoursePeriod $instructorCoursePeriod)
    {
        //
    }
}
