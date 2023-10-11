<?php

namespace App\Http\Controllers;

use App\RecommendedDoc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecommendedDocController extends Controller
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
                return RecommendedDoc::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $recommended_docs = [];
                $instructor_course_recommended_docs_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_recommended_docs_arrays[] = $instructorcourse->recommendedDocs;
                }
                foreach ($instructor_course_recommended_docs_arrays as $instructor_course_recommended_docs_array) {
                    foreach ($instructor_course_recommended_docs_array as $instructor_course_recommended_doc) {
                        $recommended_docs[] = $instructor_course_recommended_doc;
                    }
                }
                return $recommended_docs;
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
        $recommendeddocid = Str::uuid();
        RecommendedDoc::forceCreate(
            ['recommendeddocid' => $recommendeddocid] +
            $request->all());

        $recommendeddoc = RecommendedDoc::where('recommendeddocid', $recommendeddocid)->first();

        return response()->json($recommendeddoc);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecommendedDoc  $recommendeddoc
     * @return \Illuminate\Http\Response
     */
    public function show(RecommendedDoc $recommendeddoc)
    {
        return $recommendeddoc;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecommendedDoc  $recommendeddoc
     * @return \Illuminate\Http\Response
     */
    public function edit(RecommendedDoc $recommendeddoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecommendedDoc  $recommendeddoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecommendedDoc $recommendeddoc)
    {
        $recommendeddoc->update($request->all());

        $updated_recommendeddoc = RecommendedDoc::where('recommendeddocid', $recommendeddoc->recommendeddocid)->first();

        return response()->json($updated_recommendeddoc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecommendedDoc  $recommendeddoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecommendedDoc $recommendeddoc)
    {
        //
    }
}
