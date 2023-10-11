<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Instructor;
use App\InstructorCourse;
use App\SubmittedAssignment;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SubmittedAssignmentController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return SubmittedAssignment::all();
            case 'student':
                return $user->info->submittedAssignments;
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
        $folder = '/uploads/submitted-assignments/';
        // Make a file name based on title and current timestamp
        $name = $request->input('submittedassignmentid');

        $i = 0;

        while($request->hasFile("file" . $i)) {
            // Get image file
            $image = $request->file("file$i");
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . $i . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, '', $name . $i);/**/

             SubmittedAssignment::forceCreate(
                ['submittedassignmentid' => $request->input('submittedassignmentid')] +
                ['title' => $request->input('title')] +
                ['url' => asset('storage/app') . "$filePath"] +
                ['assignmentid' => $request->input('assignmentid')] +
                ['studentid' => $request->input('studentid')]
            );
            $i++;
        }

        $instructorCourse =  Assignment::find(request('assignmentid'))->instructorCourse;
        return $instructor =  Instructor::find($instructorCourse->instructorid)->confirmation_token;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function show(SubmittedAssignment $submittedAssignment)
    {
        return $submittedAssignment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmittedAssignment $submittedAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmittedAssignment $submittedAssignment)
    {
        $submittedAssignment->update($request->all());

        $updated_submittedAssignment = SubmittedAssignment::where('submittedAssignmentid', $submittedAssignment->submittedAssignmentid)->first();

        return response()->json($updated_submittedAssignment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubmittedAssignment  $submittedAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmittedAssignment $submittedAssignment)
    {
        //
    }

    public function getWordtoPDF(){
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        //Load word file
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('TempDownload/Test.docx'));

        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save('result3.pdf');
        exit;
    }
}
