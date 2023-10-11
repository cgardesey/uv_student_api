<?php

namespace App\Http\Controllers;

use App\Student;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StudentController extends Controller
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
                return Student::all();
            case 'student':
                $instructorCourses = $user->info->instructorCourses;
                $students = [];
                $students[] = $user->info;
                $instructor_course_student_arrays = [];
                foreach ($instructorCourses as $instructorCourse) {
                    $instructor_course_student_arrays[] = $instructorCourse->students;
                }
                foreach ($instructor_course_student_arrays as $instructor_course_student_array) {
                    foreach ($instructor_course_student_array as $instructor_course_student) {
                        $students[] = $instructor_course_student;
                    }
                }
                return collect($students)->unique('infoid')->values()->all();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentid = Str::uuid();
        Student::forceCreate(
            ['studentid' => $studentid] +
            $request->all());

        $student = Student::where('studentid', $studentid)->first();

        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $attributes = [];
        if($request->hasFile("picture")) {
            // Define folder path
            $folder = '/uploads/user-profile-pics/';// Get image file
            $image = $request->file("picture");// Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $student->infoid . '.' . $image->getClientOriginalExtension();// Upload image
            $this->uploadOne($image, $folder, '', $student->infoid);

            $attributes = $attributes + ['profilepicurl' => asset('storage/app') . "$filePath"];
        }

        $attributes = $attributes + [
                'title' => request('title'),
                'firstname' => request('firstname'),
                'lastname' => request('lastname'),
                'othername' => request('othername'),
                'gender' => request('gender'),
                'emailaddress' => request('emailaddress'),
                'dob' => request('dob'),
                'homeaddress' => request('homeaddress'),
                'maritalstatus' => request('maritalstatus'),
                'primarycontact' => request('primarycontact'),
                'auxiliarycontact' => request('auxiliarycontact'),
                'highestedulevel' => request('highestedulevel'),
                'highesteduinstitutionname' => request('highesteduinstitutionname')
            ];
        if ($request->has('guardianphonenumber')) {
            $attributes = $attributes +
                [
                    'guardianphonenumber' => request('guardianphonenumber'),
                    'guardian2phonenumber' => request('guardian2phonenumber')
                ];
        }
        $context = request()->all();
//        Log::info('request', $context);
        $student->update(
            $attributes
        );


        $user =  User::find($student->infoid);
        $user->update([
            'username' => request('firstname')
            ]
        );

        $updated_student = Student::where('infoid', $student->infoid)->first();

        return $updated_student;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function updateConfirmationToken(Request $request, Student $student)
    {
        $student->update($request->all());
    }
}
