<?php

namespace App\Http\Controllers;

use App\InstructorCourse;
use App\Timetable;
use App\User;
use Illuminate\Http\Request;
use App\Traits\StudentInstructorsTrait;
use Illuminate\Support\Str;

class TimetableController extends Controller
{
    use StudentInstructorsTrait;

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
                return Timetable::all();
            case 'student':
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
                return $timetables;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timetableid = Str::uuid();
        Timetable::forceCreate(
            ['timetableid' => $timetableid] +
            $request->all());

        $timetable = Timetable::where('timetableid', $timetableid)->first();

        return response()->json($timetable);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        return $timetable;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Timetable $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        $timetable->update($request->all());

        $updated_timetable = Course::where('timetableid', $timetable->timetableid)->first();

        return response()->json($updated_timetable);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}
