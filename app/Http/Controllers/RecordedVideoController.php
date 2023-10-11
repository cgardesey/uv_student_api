<?php

namespace App\Http\Controllers;

use App\RecordedVideo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecordedVideoController extends Controller
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
                return RecordedVideo::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $recorded_videos = [];
                $instructor_course_recorded_videos_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_recorded_videos_arrays[] = $instructorcourse->recordedVideos;
                }
                foreach ($instructor_course_recorded_videos_arrays as $instructor_course_recorded_videos_array) {
                    foreach ($instructor_course_recorded_videos_array as $instructor_course_recorded_video) {
                        $recorded_videos[] = $instructor_course_recorded_video;
                    }
                }
                return $recorded_videos;
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
        $videoid = Str::uuid();
        RecordedVideo::forceCreate(
            ['videoid' => $videoid] +
            $request->all());

        $video = RecordedVideo::where('videoid', $videoid)->first();

        return response()->json($video);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\RecordedVideo  $recordedVideo
     * @return \Illuminate\Http\Response
     */
    public function show(RecordedVideo $recordedVideo)
    {
        return $recordedVideo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordedVideo  $recordedVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordedVideo $recordedVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordedVideo  $recordedVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordedVideo $recordedVideo)
    {
        $recordedVideo->update($request->all());

        $updated_recorded_video = RecordedVideo::where('videoid', $recordedVideo->videoid)->first();

        return response()->json($updated_recorded_video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordedVideo  $recordedVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordedVideo $recordedVideo)
    {
        //
    }
}
