<?php

namespace App\Http\Controllers;

use App\ChatSession;
use App\InstructorCourse;
use App\User;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatSessionController extends Controller
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
                return ChatSession::all();
            case 'student':
                $chats = $user->info->chats;
                $chat_sessions = [];
                $chat_sessions_arrays = [];
                foreach ($chats as $chat) {
                    $chat_sessions_arrays[] = $chat->sessions;
                }
                foreach ($chat_sessions_arrays as $chat_sessions_array) {
                    foreach ($chat_sessions_array as $chat_session) {
                        $chat_sessions[] = $chat_session->chatSession;
                    }
                }
                return $chat_sessions;
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
        // Define folder path
        $folder = '/uploads/chat-session-docs/';
        // Make a file name based on title and current timestamp
        $name = Str::slug($request->input('title')).'_'.time();

        $i = 0;

        while($request->hasFile("file" . $i)) {
            // Get image file
            $image = $request->file("file$i");
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . $i . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, '', $name . $i);/**/

            ChatSession::forceCreate(
                ['chatsessionid' => Str::uuid()] +
                ['courseid' => $request->input('courseid')] +
                ['title' => $request->input('title')] +
                ['description' => $request->input('description')] +
                ['docurl' => $filePath] +
                ['roomid' => $request->input('assignmentid')]
            );
            $i++;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatSession  $chatsession
     * @return \Illuminate\Http\Response
     */
    public function getLiveChat(Request $request)
    {
        $latest_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')->first();

        $expired = $latest_payment ? $latest_payment->expired : true;

        $is_free_course = InstructorCourse::find(request('instructorcourseid'))->price == 0.00;

        $chatsession = ChatSession::where('instructorcourseid', '=',  request('instructorcourseid'))->first();

        return response()->json(array(
            'eligible' => $is_free_course ? true : !$expired,
            'chatsession' => $chatsession
        ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatSession  $chatsession
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatSession $chatsession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatSession  $chatsession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatSession $chatsession)
    {
        $chatsession->update($request->all());

        $updated_chatsession = ChatSession::where('chatsessionid', $chatsession->chatsessionid)->first();

        return response()->json($updated_chatsession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatSession  $chatsession
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatSession $chatsession)
    {
        //
    }
}
