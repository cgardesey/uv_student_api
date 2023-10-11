<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Instructor;
use App\Student;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


class ChatController extends Controller
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
                return Chat::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $chats = [];
                $instructor_course_chat_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_chat_arrays[] = $instructorcourse->chats;
                }
                foreach ($instructor_course_chat_arrays as $instructor_course_chat_array) {
                    foreach ($instructor_course_chat_array as $instructor_course_chat) {
                        $chats[] = $instructor_course_chat;
                    }
                }
                return $chats;
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
        $chat = Chat::find(request('chatid'));
        if (!$chat) {
            $attributes = [
                'chatid' => request('chatid'),
                'chatrefid' => request('chatrefid'),
                'tempid' => request('tempid'),
                'instructorcourseid' => request('instructorcourseid'),
                'senderid' => request('senderid')
            ];
            if ($request->has('file')) {

                // Get image file
                $image = $request->file('file');// Make a file name based on attachmenttitle and current timestamp
                $title = $request->input('chatid');// Define folder path
                $folder = '/uploads/chats/';// Make a file path where image will be stored [ folder path + file name + file extension]
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
            $chat = Chat::forceCreate($attributes);
            $sender = User::find(request('senderid'));
            if ($sender->role == "student") {
                $student = Student::find(request('senderid'));
                if ($request->has('chatrefid')) {
                    $referenced_chat = Chat::find(request('chatrefid'));
                    return Response::json(array(
                        'chat' => $chat,
                        'sender' => $sender,
                        'student' => $student,
                        'referenced_chat' => $referenced_chat
                    ));
                } else {
                    return Response::json(array(
                        'chat' => $chat,
                        'sender' => $sender,
                        'student' => $student,
                    ));
                }
            } else if ($sender->role == "instructor")
                {
                $instructor = Instructor::find(request('senderid'));
                    if ($request->has('chatrefid')) {
                        $referenced_chat = Chat::find(request('chatrefid'));
                        return Response::json(array(
                            'chat' => $chat,
                            'sender' => $sender,
                            'instructor' => $instructor,
                            'referenced_chat' => $referenced_chat
                        ));
                    } else {
                        return Response::json(array(
                            'chat' => $chat,
                            'sender' => $sender,
                            'instructor' => $instructor,
                        ));
                    }
                }
        } else {
            return Response::json(array(
                'already_exists' => true,
                'chat' => $chat
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        return $chat;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        $chat->update($request->all());

        $updated_chat = Chat::where('chatid', $chat->chatid)->first();

        return response()->json($updated_chat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
