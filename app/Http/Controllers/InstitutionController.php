<?php

namespace App\Http\Controllers;

use App\Institution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstitutionController extends Controller
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
                return Institution::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $institutions = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $institution = $instructorcourse->institution;
                    if ($institution) {
                        $institutions[] = $institution;
                    }
                }
                return $institutions;
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
        $institutionid = Str::uuid();
        Institution::forceCreate(
            ['institutionid' => $institutionid] +
            $request->all());

        $institution = Institution::where('institutionid', $institutionid)->first();

        return response()->json($institution);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        return $institution;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        $institution->update($request->all());

        $updated_institution = Institution::where('institutionid', $institution->institutionid)->first();

        return response()->json($updated_institution);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        //
    }
}
