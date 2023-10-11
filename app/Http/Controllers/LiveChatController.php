<?php

namespace App\Http\Controllers;

use App\LiveChat;
use App\Instructor;
use App\Student;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


class LiveChatController extends Controller
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
                return LiveChat::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $live_chats = [];
                $instructor_course_live_chat_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_live_chat_arrays[] = $instructorcourse->liveChats;
                }
                foreach ($instructor_course_live_chat_arrays as $instructor_course_live_chat_array) {
                    foreach ($instructor_course_live_chat_array as $instructor_course_live_chat) {
                        $live_chats[] = $instructor_course_live_chat;
                    }
                }
                return $live_chats;
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
        $liveChat = LiveChat::find(request('livechatid'));
        if (!$liveChat) {
            $attributes = [
                'livechatid' => request('livechatid'),
                'livechatrefid' => request('livechatrefid'),
                'tempid' => request('tempid'),
                'instructorcourseid' => request('instructorcourseid'),
                'senderid' => request('senderid')
            ];
            if ($request->has('file')) {

                // Get image file
                $image = $request->file('file');// Make a file name based on attachmenttitle and current timestamp
                $title = $request->input('livechatid');// Define folder path
                $folder = '/uploads/livechats/';// Make a file path where image will be stored [ folder path + file name + file extension]
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
            $liveChat = LiveChat::forceCreate($attributes);
            $sender = User::find(request('senderid'));
            if ($sender->role == "student") {
                $student = Student::find(request('senderid'));
                if ($request->has('livechatrefid')) {
                    $referenced_live_chat = LiveChat::find(request('livec
                    hatrefid'));
                    return Response::json(array(
                        'live_chat' => $liveChat,
                        'sender' => $sender,
                        'student' => $student,
                        'referenced_live_chat' => $referenced_live_chat
                    ));
                } else {
                    return Response::json(array(
                        'live_chat' => $liveChat,
                        'sender' => $sender,
                        'student' => $student,
                    ));
                }
            } else if ($sender->role == "instructor")
            {
                $instructor = Instructor::find(request('senderid'));
                if ($request->has('livechatrefid')) {
                    $referenced_live_chat = LiveChat::find(request('livechatrefid'));
                    return Response::json(array(
                        'live_chat' => $liveChat,
                        'sender' => $sender,
                        'instructor' => $instructor,
                        'referenced_live_chat' => $referenced_live_chat
                    ));
                } else {
                    return Response::json(array(
                        'live_chat' => $liveChat,
                        'sender' => $sender,
                        'instructor' => $instructor,
                    ));
                }
            }
        } else {
            return Response::json(array(
                'already_exists' => true,
                'live_chat' => $liveChat
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiveChat $liveChat
     * @return \Illuminate\Http\Response
     */
    public function show(LiveChat $liveChat)
    {
        return $liveChat;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiveChat $liveChat
     * @return \Illuminate\Http\Response
     */
    public function edit(LiveChat $liveChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LiveChat $liveChat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiveChat $liveChat)
    {
        $liveChat->update($request->all());

        $updated_live_chat = LiveChat::where('livechatid', $liveChat->liveChatid)->first();

        return response()->json($updated_live_chat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiveChat $liveChat
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveChat $liveChat)
    {
        //
    }
}
