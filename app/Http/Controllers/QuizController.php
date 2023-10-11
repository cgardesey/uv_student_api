<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
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
                return Quiz::all();
            case 'student':
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
                return $quizzes;
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
        $quizid = Str::uuid();
        quiz::forceCreate(
            ['quizid' => $quizid] +
            $request->all());

        $quiz = Quiz::where('quizid', $quizid)->first();

        return response()->json($quiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return $quiz;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->update($request->all());

        $updated_quiz = Quiz::where('quizid', $quiz->quizid)->first();

        return response()->json($updated_quiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
