<?php

namespace App\Http\Controllers;

use App\PastQuestion;
use App\Instructor;
use App\Student;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


class PastQuestionController extends Controller
{
    use UploadTrait;

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
                return PastQuestion::all();
            case 'student':
                return PastQuestion::all();
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
        $pastQuestion = PastQuestion::find(request('pastquestionid'));
        if (!$pastQuestion) {
            $attributes = [
                'pastquestionid' => request('pastquestionid'),
                'pastquestionrefid' => request('pastquestionrefid'),
                'tempid' => request('tempid'),
                'instructorcourseid' => request('instructorcourseid'),
                'senderid' => request('senderid')
            ];
            if ($request->has('file')) {

                // Get image file
                $image = $request->file('file');// Make a file name based on attachmenttitle and current timestamp
                $title = $request->input('pastquestionid');// Define folder path
                $folder = '/uploads/pastquestions/';// Make a file path where image will be stored [ folder path + file name + file extension]
                $filePath = $folder . $title . '.' . $image->getClientOriginalExtension();// Upload image
                $this->uploadOne($image, $folder, '', $title);

                Log::info('debit_response', [
                    'generated_path' => asset('storage/app')
                ]);
                $attributes = $attributes +
                    [
                        'attachmenturl' =>  asset('storage/app') . "$filePath",
                        'attachmenttype' => request('attachmenttype'),
                        'attachmenttitle' => request('attachmenttitle')
                    ];
            } else {
                if ($request->has('attachmenturl')) {
                    $attributes = $attributes +
                        [
                            'attachmenturl' => request('attachmenturl'),
                            'attachmenttype' => request('attachmenttype'),
                            'attachmenttitle' => request('attachmenttitle')
                        ];
                }
                $attributes = $attributes +
                    [
                        'text' => request('text'),
                        'link' => request('link'),
                        'linktitle' => request('linktitle'),
                        'linkdescription' => request('linkdescription'),
                        'linkimage' => request('linkimage')
                    ];
            }
            $pastQuestion = PastQuestion::forceCreate($attributes);
            $sender = User::find(request('senderid'));
            if ($sender->role == "student") {
                $student = Student::find(request('senderid'));
                if ($request->has('pastquestionrefid')) {
                    $referenced_past_question = PastQuestion::find(request('pastc
                    hatrefid'));
                    return Response::json(array(
                        'past_question' => $pastQuestion,
                        'sender' => $sender,
                        'student' => $student,
                        'referenced_past_question' => $referenced_past_question
                    ));
                } else {
                    return Response::json(array(
                        'past_question' => $pastQuestion,
                        'sender' => $sender,
                        'student' => $student,
                    ));
                }
            } else if ($sender->role == "instructor")
            {
                $instructor = Instructor::find(request('senderid'));
                if ($request->has('pastquestionrefid')) {
                    $referenced_past_question = PastQuestion::find(request('pastquestionrefid'));
                    return Response::json(array(
                        'past_question' => $pastQuestion,
                        'sender' => $sender,
                        'instructor' => $instructor,
                        'referenced_past_question' => $referenced_past_question
                    ));
                } else {
                    return Response::json(array(
                        'past_question' => $pastQuestion,
                        'sender' => $sender,
                        'instructor' => $instructor,
                    ));
                }
            }
        } else {
            return Response::json(array(
                'already_exists' => true,
                'past_question' => $pastQuestion
            ));
        }
    }


    public function fetchQuestion()
    {
        $questionid = request('questionid');
        $questionid = str_replace('SHS >> School Direct Top SHS >> Elective >> SHS 3 >> ', 'SHS >> ', $questionid);
        $questionid = str_replace('SHS >> School Direct Top SHS >> Core >> SHS 3 >> ', 'SHS >> ', $questionid);

        Log::info('sdfs', [
            '$questionid' => $questionid
        ]);

        return PastQuestion::where('questionid', $questionid)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PastQuestion $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function uniqueYears()
    {
        $coursepath = request('coursepath');
        $coursepath = str_replace('SHS >> School Direct Top SHS >> Elective >> SHS 3 >> ', 'SHS >> ', $coursepath);
        $coursepath = str_replace('SHS >> School Direct Top SHS >> Core >> SHS 3 >> ', 'SHS >> ', $coursepath);
        $results = DB::select("SELECT DISTINCT(SUBSTRING_INDEX(SUBSTRING_INDEX(filtered_past_questions.questionid, \" >> \", 3), \" >> \", -1)) AS Years FROM (SELECT * FROM past_questions WHERE questionid LIKE '%{$coursepath}%' ) AS filtered_past_questions");
        $years = [];
        foreach($results as $result) {
            $years[] = $result->Years;
        }
        return $years;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PastQuestion $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(PastQuestion $pastQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\PastQuestion $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PastQuestion $pastQuestion)
    {
        $pastQuestion->update($request->all());

        $updated_past_question = PastQuestion::where('pastquestionid', $pastQuestion->pastQuestionid)->first();

        return response()->json($updated_past_question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PastQuestion $pastQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PastQuestion $pastQuestion)
    {
        //
    }
}
