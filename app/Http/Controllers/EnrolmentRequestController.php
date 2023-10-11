<?php

namespace App\Http\Controllers;

use App\EnrolmentRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EnrolmentRequestController extends Controller
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
                return EnrolmentRequest::all();
            case 'instructor':
                $requests = $user->info->requests;
                $enrolmentrequests = [];
                foreach ($requests as $request) {
                    $enrolmentrequests[] = $request->enrolmentRequest;
                }
                return $enrolmentrequests;
            case 'student':
                return EnrolmentRequest::all();
            default:
                'default';
                break;
        }
    }

    public function students(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':

            case 'instructor':

            case 'student':
                return EnrolmentRequest::find(request('enrolmentrequestid'))->students;

            default:
                'default';
                break;
        }
    }

    public function requestEnrolments()
    {
        /*return DB::table('enrolment_requests')
            ->join('enrolments', 'enrolment_requests.enrolmentid', '=', 'enrolments.infoid')
            ->join('requests', 'enrolment_requests.requestid', '=', 'requests.requestid')
            ->select('enrolment_requests.enrolmentrequestid', 'enrolments.profilepicurl','enrolments.title', 'enrolments.firstname', 'enrolments.lastname', 'enrolments.othername', 'enrolments.edubackground', 'enrolments.about','requests.description', 'enrolment_requests.total_ratings', 'enrolment_requests.rating')
            ->where('requests.requestpath', request('requestpath'))
            ->get();*/

        $request = Request::where('requests.requestpath', request('requestpath'))->first();
        if ($request) {
            $requestid = $request->requestid;
            $enrolmentrequests = EnrolmentRequest::with(['request', 'enrolment'])->where('requestid', $requestid)->get();
            $enrolmentrequests_with = [];
            foreach ($enrolmentrequests as $enrolmentrequest) {
                $enrolmentrequests_with[] = $enrolmentrequest->makeHidden('ratings')->append(['total_ratings', 'rating']);
            }
            return response()->json(array(
                'request_enrolments' => $enrolmentrequests_with
            ));
        }
        else {
            return response()->json(array(
                'request_exists' => false
            ));
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
        $enrolment_request = EnrolmentRequest::where('studentid', request('studentid'))->where('instructorcourseid', request('instructorcourseid'))->first();

        if (!$enrolment_request) {
            $enrolmentrequestid = Str::uuid();
            EnrolmentRequest::forceCreate(
                ['enrolmentrequestid' => $enrolmentrequestid] +
                $request->all());

            $enrolment_request = EnrolmentRequest::where('enrolmentrequestid', $enrolmentrequestid)->first();

            return Response::json(array(
                'successful' => 1,
                'enrolment_request' => $enrolment_request
            ));
        } else {
            if ($enrolment_request->enrolled) {
                return response()->json(array(
                    'already_enrolled' => 1
                ));
            } else {
                return response()->json(array(
                    'pending_approval' => 1
                ));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EnrolmentRequest  $enrolmentrequest
     * @return \Illuminate\Http\Response
     */
    public function show($enrolmentrequestid)
    {
        $enrolmentrequest = EnrolmentRequest::where('enrolmentrequestid', $enrolmentrequestid)->first();

        return response()->json($enrolmentrequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EnrolmentRequest  $enrolmentrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(EnrolmentRequest $enrolmentrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnrolmentRequest  $enrolmentrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnrolmentRequest $enrolmentrequest)
    {
        $enrolmentrequest->update($request->all());

        $updated_enrolmentrequest = EnrolmentRequest::where('enrolmentrequestid', $enrolmentrequest->enrolmentrequestid)->first();

        return response()->json($updated_enrolmentrequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EnrolmentRequest  $enrolmentrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnrolmentRequest $enrolmentrequest)
    {
        //
    }
}
