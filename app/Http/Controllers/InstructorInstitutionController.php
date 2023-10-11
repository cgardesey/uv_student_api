<?php

namespace App\Http\Controllers;

use App\Enrolment;
use App\InstructorInstitution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstructorInstitutionController extends Controller
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
                return InstructorInstitution::all();
            case 'instructor':
                $institutions = $user->info->institutions;
                $instructorinstitutions = [];
                foreach ($institutions as $institution) {
                    $instructorinstitutions[] = $institution->instructorInstitution;
                }
                return $instructorinstitutions;
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
        $instructorinstitutionid = Str::uuid();
        InstructorInstitution::forceCreate(
            ['instructorinstitutionid' => $instructorinstitutionid] +
            $request->all());

        $instructorinstitution = InstructorInstitution::where('instructorinstitutionid', $instructorinstitutionid)->first();

        return response()->json($instructorinstitution);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstructorInstitution  $instructorinstitution
     * @return \Illuminate\Http\Response
     */
    public function show(InstructorInstitution $instructorinstitution)
    {
        return $instructorinstitution;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstructorInstitution  $instructorinstitution
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorInstitution $instructorinstitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstructorInstitution  $instructorinstitution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstructorInstitution $instructorinstitution)
    {
        $instructorinstitution->update($request->all());

        $updated_instructorinstitution = InstructorInstitution::where('instructorinstitutionid', $instructorinstitution->instructorinstitutionid)->first();

        return response()->json($updated_instructorinstitution);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstructorInstitution  $instructorinstitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstructorInstitution $instructorinstitution)
    {
        //
    }
}
