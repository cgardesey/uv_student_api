<?php

namespace App\Http\Controllers;

use App\EnrolmentRequest;
use App\SubscriptionChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionChangeRequestController extends Controller
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
     * @param  \App\SubscriptionChangeRequest  $subscriptionChangeRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionChangeRequest $subscriptionChangeRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubscriptionChangeRequest  $subscriptionChangeRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionChangeRequest $subscriptionChangeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubscriptionChangeRequest  $subscriptionChangeRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionChangeRequest $subscriptionChangeRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubscriptionChangeRequest  $subscriptionChangeRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionChangeRequest $subscriptionChangeRequest)
    {
        //
    }

    public function requestSubscriptionChange(Request $request)
    {
        /*return DB::table('enrolment_requests')
            ->join('enrolments', 'enrolment_requests.enrolmentid', '=', 'enrolments.infoid')
            ->join('requests', 'enrolment_requests.requestid', '=', 'requests.requestid')
            ->select('enrolment_requests.enrolmentrequestid', 'enrolments.profilepicurl','enrolments.title', 'enrolments.firstname', 'enrolments.lastname', 'enrolments.othername', 'enrolments.edubackground', 'enrolments.about','requests.description', 'enrolment_requests.total_ratings', 'enrolment_requests.rating')
            ->where('requests.requestpath', request('requestpath'))
            ->get();*/

        $subscriptionChangeRequest = SubscriptionChangeRequest::where('studentid', request('studentid'))
            ->where('institutionid', request('institutionid'))
            ->first();
        if ($subscriptionChangeRequest) {
            return response()->json(array(
                'request_already_exist' => true
            ));
        }
        else {
            SubscriptionChangeRequest::forceCreate(
                ['subscriptionchangerequestid' => Str::uuid()] +
                $request->all());

            return response()->json(array(
                'request_successfully_sent' => true
            ));
        }
    }
}
