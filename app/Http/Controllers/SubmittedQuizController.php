<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Instructor;
use App\Quiz;
use App\SubmittedQuiz;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class SubmittedQuizController extends Controller
{
    use UploadTrait;

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
                return SubmittedQuiz::all();
            case 'student':
                return $user->info->submittedQuizzes;
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
        $submittedquizid = Str::uuid();
        SubmittedQuiz::forceCreate(
            ['submittedquizid' => $submittedquizid] +
            $request->all());

        $submitted_quiz = SubmittedQuiz::where('submittedquizid', $submittedquizid)->first();

        $instructorCourse =  Quiz::find(request('quizid'))->instructorCourse;
        $confirmation_token =  Instructor::find($instructorCourse->instructorid)->confirmation_token;

        return Response::json(array(
            'confirmation_token' => $confirmation_token,
            'submitted_quiz' => $submitted_quiz
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubmittedQuiz $submittedQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(SubmittedQuiz $submittedQuiz)
    {
        return $submittedQuiz;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubmittedQuiz $submittedQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmittedQuiz $submittedQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\SubmittedQuiz $submittedQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmittedQuiz $submittedQuiz)
    {
        $submittedQuiz->update($request->all());

        $updated_submittedQuiz = SubmittedQuiz::where('submittedQuizid', $submittedQuiz->submittedQuizid)->first();

        return response()->json($updated_submittedQuiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubmittedQuiz $submittedQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmittedQuiz $submittedQuiz)
    {
        //
    }
}
