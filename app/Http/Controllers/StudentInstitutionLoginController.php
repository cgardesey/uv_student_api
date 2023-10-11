<?php

namespace App\Http\Controllers;

use App\StudentInstitutionLogin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentInstitutionLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentInstitutionLogin  $studentInstitutionLogin
     * @return \Illuminate\Http\Response
     */
    public function show(StudentInstitutionLogin $studentInstitutionLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentInstitutionLogin  $studentInstitutionLogin
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentInstitutionLogin $studentInstitutionLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentInstitutionLogin  $studentInstitutionLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentInstitutionLogin $studentInstitutionLogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentInstitutionLogin  $studentInstitutionLogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentInstitutionLogin $studentInstitutionLogin)
    {
        //
    }

    public function StudentInstitutionLogin(Request $request){
        $student_institution_login = StudentInstitutionLogin::where('studentno', request('studentno'))
            ->where('studentid', request('studentid'))
            ->where('institutionid', request('institutionid'))
            ->first();

        if(!$student_institution_login){
            return response()->json(array(
                'user_not_found' => true
            ));
        }
        elseif (Hash::check(request('password'), $student_institution_login->password)){
            return response()->json(array(
                'login_successful' => true
            ));
        }
        else {
            return response()->json(array(
                'incorrect_password' => true
            ));
        }
    }
}
