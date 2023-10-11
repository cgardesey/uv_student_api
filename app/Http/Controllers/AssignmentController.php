<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return Assignment::all();
            case 'student':
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
                return $assignments;
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
        $assignmentid = Str::uuid();
        assignment::forceCreate(
            ['assignmentid' => $assignmentid] +
            $request->all());

        $assignment = Assignment::where('assignmentid', $assignmentid)->first();

        return response()->json($assignment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return $assignment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $assignment->update($request->all());

        $updated_assignment = Assignment::where('assignmentid', $assignment->assignmentid)->first();

        return response()->json($updated_assignment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
