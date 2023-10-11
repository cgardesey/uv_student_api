<?php

namespace App\Http\Controllers;

use App\RecordedVideoStream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecordedVideoStreamController extends Controller
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
                return RecordedVideoStream::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $recorded_video_streams = [];
                $instructor_course_recorded_video_streams_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_recorded_video_streams_arrays[] = $instructorcourse->recordedVideoStreams;
                }
                foreach ($instructor_course_recorded_video_streams_arrays as $instructor_course_recorded_video_streams_array) {
                    foreach ($instructor_course_recorded_video_streams_array as $instructor_course_recorded_video_stream) {
                        if ($instructor_course_recorded_video_stream->url != null && $instructor_course_recorded_video_stream->url != "") {
                            $recorded_video_streams[] = $instructor_course_recorded_video_stream;
                        }
                    }
                }
                return $recorded_video_streams;
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
        $recordedvideostreamid = Str::uuid();
        RecordedVideoStream::forceCreate(
            ['recordedvideostreamid' => $recordedvideostreamid] +
            $request->all());

        $recordedVideoStream = RecordedVideoStream::where('recordedvideostreamid', $recordedvideostreamid)->first();

        return response()->json($recordedVideoStream);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\RecordedVideoStream  $recordedVideoStream
     * @return \Illuminate\Http\Response
     */
    public function show(RecordedVideoStream $recordedVideoStream)
    {
        return $recordedVideoStream;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordedVideoStream  $recordedVideoStream
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordedVideoStream $recordedVideoStream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordedVideoStream  $recordedVideoStream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordedVideoStream $recordedVideoStream)
    {
        $recordedVideoStream->update($request->all());

        $updated_recorded_video_stream = RecordedVideoStream::where('recordedvideostreamid', $recordedVideoStream->recordedvideostreamid)->first();

        return response()->json($updated_recorded_video_stream);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordedVideoStream  $recordedVideoStream
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordedVideoStream $recordedVideoStream)
    {
        //
    }
}
