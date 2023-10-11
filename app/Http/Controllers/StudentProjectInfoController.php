<?php

namespace App\Http\Controllers;

use App\AppUserFee;
use App\StudentProjectInfo;
use Illuminate\Http\Request;

class StudentProjectInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return StudentProjectInfo::first();
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
     * @param  \App\StudentProjectInfo  $studentProjectInfo
     * @return \Illuminate\Http\Response
     */
    public function show(StudentProjectInfo $studentProjectInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentProjectInfo  $studentProjectInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentProjectInfo $studentProjectInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentProjectInfo  $studentProjectInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentProjectInfo $studentProjectInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentProjectInfo  $studentProjectInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentProjectInfo $studentProjectInfo)
    {
        //
    }
}
