<?php

namespace App\Http\Controllers;

use App\RecordedStream;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecordedStreamController extends Controller
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
                return RecordedStream::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $recorded_streams = [];
                $instructor_course_recorded_streams_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_recorded_streams_arrays[] = $instructorcourse->recordedStreams;
                }
                foreach ($instructor_course_recorded_streams_arrays as $instructor_course_recorded_streams_array) {
                    foreach ($instructor_course_recorded_streams_array as $instructor_course_recorded_stream) {
                        $recorded_streams[] = $instructor_course_recorded_stream;
                    }
                }
                return $recorded_streams;
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
        $recordedstreamid = Str::uuid();
        RecordedStream::forceCreate(
            ['recordedstreamid' => $recordedstreamid] +
            $request->all());

        $stream = RecordedStream::where('recordedstreamid', $recordedstreamid)->first();

        return response()->json($stream);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\RecordedStream  $recordedStream
     * @return \Illuminate\Http\Response
     */
    public function show(RecordedStream $recordedStream)
    {
        return $recordedStream;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordedStream  $recordedStream
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordedStream $recordedStream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordedStream  $recordedStream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordedStream $recordedStream)
    {
        $recordedStream->update($request->all());

        $updated_recorded_stream = RecordedStream::where('recordedstreamid', $recordedStream->recordedstreamid)->first();

        return response()->json($updated_recorded_stream);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordedStream  $recordedStream
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordedStream $recordedStream)
    {
        //
    }
}
