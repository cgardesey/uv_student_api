<?php

namespace App\Http\Controllers;

use App\Audio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AudioController extends Controller
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
                return Audio::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $audios = [];
                $instructor_course_audios_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_audios_arrays[] = $instructorcourse->audios;
                }
                foreach ($instructor_course_audios_arrays as $instructor_course_audios_array) {
                    foreach ($instructor_course_audios_array as $instructor_course_audio) {
                        $audios[] = $instructor_course_audio;
                    }
                }
                return $audios;
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
        $folder = '/uploads/audio-docs/';
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

            Audio::forceCreate(
                ['audioid' => Str::uuid()] +
                ['title' => $request->input('title')] +
                ['url' => asset('storage/app') . "$filePath"] +
                ['courseid' => $request->input('courseid')]
            );
            $i++;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show(Audio $audio)
    {
        return $audio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit(Audio $audio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audio $audio)
    {
        $audio->update($request->all());

        $updated_audio = Audio::where('audioid', $audio->audioid)->first();

        return response()->json($updated_audio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audio $audio)
    {
        //
    }

    public function fetchLatestAudio(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return Audio::all();
            case 'student':
                $courses = $user->info->courses;
                $audios = [];
                $course_audios_arrays = [];
                foreach ($courses as $course) {
                    $course_audios_arrays[] = $course->audios;
                }
                foreach ($course_audios_arrays as $course_audios_array) {
                    foreach ($course_audios_array as $course_audio) {
                        $audios[] = $course_audio;
                    }
                }
                return $audios;
            default:
                'default';
                break;
        }
    }
}
