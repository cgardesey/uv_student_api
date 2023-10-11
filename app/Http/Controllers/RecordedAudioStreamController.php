<?php

namespace App\Http\Controllers;

use App\RecordedAudioStream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecordedAudioStreamController extends Controller
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
                return RecordedAudioStream::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $recorded_audio_streams = [];
                $instructor_course_recorded_audio_streams_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_recorded_audio_streams_arrays[] = $instructorcourse->recordedAudioStreams;
                }
                foreach ($instructor_course_recorded_audio_streams_arrays as $instructor_course_recorded_audio_streams_array) {
                    foreach ($instructor_course_recorded_audio_streams_array as $instructor_course_recorded_audio_stream) {
                        if ($instructor_course_recorded_audio_stream->url != null && $instructor_course_recorded_audio_stream->url != "") {
                            $recorded_audio_streams[] = $instructor_course_recorded_audio_stream;
                        }
                    }
                }
                return $recorded_audio_streams;
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
        $recordedaudiostreamid = Str::uuid();
        RecordedAudioStream::forceCreate(
            ['recordedaudiostreamid' => $recordedaudiostreamid] +
            $request->all());

        $recordedAudioStream = RecordedAudioStream::where('recordedaudiostreamid', $recordedaudiostreamid)->first();

        return response()->json($recordedAudioStream);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\RecordedAudioStream  $recordedAudioStream
     * @return \Illuminate\Http\Response
     */
    public function show(RecordedAudioStream $recordedAudioStream)
    {
        return $recordedAudioStream;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordedAudioStream  $recordedAudioStream
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordedAudioStream $recordedAudioStream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordedAudioStream  $recordedAudioStream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordedAudioStream $recordedAudioStream)
    {
        $recordedAudioStream->update($request->all());

        $updated_recorded_audio_stream = RecordedAudioStream::where('recordedaudiostreamid', $recordedAudioStream->recordedaudiostreamid)->first();

        return response()->json($updated_recorded_audio_stream);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordedAudioStream  $recordedAudioStream
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordedAudioStream $recordedAudioStream)
    {
        //
    }
}
