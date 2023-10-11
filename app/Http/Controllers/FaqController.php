<?php

namespace App\Http\Controllers;

use App\InstructorCourse;
use App\Faq;
use App\User;
use Illuminate\Http\Request;
use App\Traits\StudentInstructorsTrait;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    use StudentInstructorsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Faq::all();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faqid = Str::uuid();
        Faq::forceCreate(
            ['faqid' => $faqid] +
            $request->all());

        $faq = Faq::where('faqid', $faqid)->first();

        return response()->json($faq);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return $faq;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->update($request->all());

        $updated_faq = Course::where('faqid', $faq->faqid)->first();

        return response()->json($updated_faq);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
