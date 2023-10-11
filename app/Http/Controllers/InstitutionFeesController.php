<?php

namespace App\Http\Controllers;

use App\Course;
use App\InstitutionFee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstitutionFeesController extends Controller
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
     * @param  \App\InstitutionFee  $institutionFees
     * @return \Illuminate\Http\Response
     */
    public function show(InstitutionFee $institutionFees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstitutionFee  $institutionFees
     * @return \Illuminate\Http\Response
     */
    public function edit(InstitutionFee $institutionFees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstitutionFee  $institutionFees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstitutionFee $institutionFees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstitutionFee  $institutionFees
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstitutionFee $institutionFees)
    {
        //
    }

    public function getInstitutionFees(Request $request)
    {
        return InstitutionFee::where('institutionid', request('institutionid'))->get();
    }
}
