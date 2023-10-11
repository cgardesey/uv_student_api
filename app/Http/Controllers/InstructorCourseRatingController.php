<?php

namespace App\Http\Controllers;

use App\InstructorCourse;
use App\InstructorCourseRating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class InstructorCourseRatingController extends Controller
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
                return InstructorCourseRating::all();
            case 'student':
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
                }
                return $instructor_course_ratings;
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
        $instructorcourseratingid = Str::uuid();
        InstructorCourseRating::forceCreate(
            ['instructorcourseratingid' => $instructorcourseratingid] +
            $request->all());

        $instructorCourseRating = InstructorCourseRating::where('instructorcourseratingid', $instructorcourseratingid)->first();
        $instructorCourse = InstructorCourse::where('instructorcourseid', request('instructorcourseid'))->first();

        return Response::json(array(
            'instructor_course' => $instructorCourse,
            'instructor_course_rating' => $instructorCourseRating
        ));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\InstructorCourseRating  $instructorCourseRating
     * @return \Illuminate\Http\Response
     */
    public function show(InstructorCourseRating $instructorCourseRating)
    {
        return $instructorCourseRating;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstructorCourseRating  $instructorCourseRating
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorCourseRating $instructorCourseRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstructorCourseRating  $instructorCourseRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstructorCourseRating $instructorCourseRating)
    {
        $instructorCourseRating->update($request->all());

        $updated_instructorCourseRating = InstructorCourseRating::where('instructorcourseratingid', $instructorCourseRating->instructorcourseratingid)->first();

        return response()->json($updated_instructorCourseRating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstructorCourseRating  $instructorCourseRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstructorCourseRating $instructorCourseRating)
    {
        //
    }
}
