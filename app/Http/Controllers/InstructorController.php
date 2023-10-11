<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstructorController extends Controller
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
                return Instructor::all();
            case 'student':
                $instructor_courses = $user->info->instructorCourses;
                $instructors = [];
                foreach ($instructor_courses as $instructor_course) {
                    $instructors[] = $instructor_course->instructor;
                }
                return $instructors;

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
        $instructorid = Str::uuid();
        Instructor::forceCreate(
            ['instructorid' => $instructorid] +
            $request->all());

        $instructor = Instructor::where('instructorid', $instructorid)->first();

        return response()->json($instructor);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return $instructor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $instructor->update($request->all());

        $updated_instructor = Instructor::where('infoid', $instructor->infoid)->first();

        return response()->json($updated_instructor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
