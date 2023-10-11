<?php

namespace App\Http\Controllers;

use App\ClassSession;
use App\Enrolment;
use App\Institution;
use App\InstitutionFee;
use App\InstructorCourse;
use App\AppUserFee;
use App\Payment;
use App\SubscriptionChangeRequest;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
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
                return Payment::all();
            case 'student':
                Payment::whereNull('paymentref')->delete();
                return Payment::where('payerid', '=', $user->userid)->get();
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
     * @param \Illuminate\Http\Request $request `
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userid = User::where('api_token', '=', $request->bearerToken())->first()->userid;
        Payment::whereNull('paymentref')->delete();
        $enrolmentid = '';
        $institutionid = '';
        $payment = null;
        if ($request->has('enrolmentid')) {
            $enrolmentid = request('enrolmentid');
            $payment = Payment::where('enrolmentid', $enrolmentid)->latest('created_at')->first();
        } else {
            $institutionid = request('institutionid');
            $payment = Payment::where('institutionid', $institutionid)
                ->where('payerid', $userid)
                ->latest('created_at')
                ->first();
        }

        $momo_api_client_id = env("MOMO_API_CLIENT_ID");
        $momo_api_client_password = env("MOMO_API_CLIENT_PASSWORD");
        $MOMO_API_BASE_URL = env("MOMO_API_BASE_URL");
        if (!$payment) {
            $payment = new Payment(['paymentid' => Str::uuid()] + $request->all());
            //Confirm if mobile number is registered on mobile money network.
            $curl = curl_init();
            $payment_token = hash('sha512', $payment->paymentid . '' . $momo_api_client_id . '' . $momo_api_client_password . '');
            $MOMO_API_BASE_URL = $MOMO_API_BASE_URL;
            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$MOMO_API_BASE_URL}customerstatus",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"header\": {\"clientid\": \"uvstudent\",\"countrycode\": \"{$payment->countrycode}\",\"requestid\": \"{$payment->paymentid}\",\"token\": \"{$payment_token}\"},\"msisdn\": \"{$payment->msisdn}\",\"network\": \"{$payment->network}\"}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $registration_status_response = curl_exec($curl);

            curl_close($curl);
            //end check
            $decoded_registration_status_response = json_decode($registration_status_response);
//            if (!($decoded_registration_status_response->header->message == 'SUCCESS' && $decoded_registration_status_response->header->status == '000' && $decoded_registration_status_response->customerstatus == "TRUE")) {
            if (false) {
                return response()->json(array(
                    'not_registered' => true
                ));
            }
            $stored_payment = $this->storePayment($request);

            return response()->json(array(
                'stored_payment' => $stored_payment
            ));
        }
        $already_subscribed = true;
        if ($request->has('enrolmentid')) {
            $enrolment = Enrolment::find($enrolmentid);
            $already_subscribed = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        } else {
            $institution = Institution::find($institutionid);

            $latest_payment = Payment::where('institutionid', '=', $institutionid)
                ->where('payerid', $userid)
                ->latest('created_at')
                ->whereNotNull('institutionfeeexpirydate')
                ->first();

            if ($request->has('markpreviouspaymentexpired')) {
                $latest_payment->update(
                    [
                        'institutionfeeexpirydate' => date_create(date('d-m-Y'))
                    ]
                );
                $already_subscribed = false;
            } else {
                $already_subscribed = !($latest_payment ? $latest_payment->institutionfeeexpired : true);
            }


        }

        if ($already_subscribed) {
            if ($request->has('enrolmentid')) {
                return response()->json(array(
                    'already_subscribed' => true,
                    'payment' => $payment,
                    'enrolment' => $enrolment
                ));
            } else {
                $enrolments = Enrolment::where('studentid', '=', request('payerid'))->get();
                $institution_enrolments = [];
                foreach ($enrolments as $enrolment) {
                    if (InstructorCourse::find($enrolment->instructorcourseid)->institutionid == $institution->institutionid) {
                        $institution_enrolments[] = $enrolment;
                    }
                }
                return response()->json(array(
                    'already_subscribed' => true,
                    'payment' => $payment,
                    'institution' => $institution,
                    'institution_enrolments' => $institution_enrolments,
                ));
            }
        }
        $pending_payment = null;
        if ($request->has('enrolmentid')) {
            $pending_payment = Payment::where('enrolmentid', $enrolmentid)
                ->where('status', '=', 'ACCEPTED')
                ->orWhere('status', '=', 'PENDING')
                ->latest('created_at')->first();
        } else {
            $pending_payment = Payment::where('institutionid', $institutionid)
                ->where('payerid', $userid)
                ->where('status', '=', 'ACCEPTED')
                ->orWhere('status', '=', 'PENDING')
                ->latest('created_at')->first();
        }
        if ($pending_payment) {
            $time_created = Carbon::createFromFormat('Y-m-d H:i:s', $pending_payment->created_at);
            $now = Carbon::now();
            $wait_time = 0 - $now->diffInRealMinutes($time_created);

            if ($wait_time <= 0) {
                //Check status
                $curl = curl_init();
                $momo_api_client_id = $momo_api_client_id;
                $momo_api_client_password = $momo_api_client_password;
                $pending_payment_token = hash('sha512', $pending_payment->paymentid . '' . $momo_api_client_id . '' . $momo_api_client_password . '');
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "{$MOMO_API_BASE_URL}transactionstatus",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"header\": {\"clientid\": \"uvstudent\",\"countrycode\": \"{$pending_payment->countrycode}\",\"requestid\": \"{$pending_payment->paymentid}\",\"token\": \"{$pending_payment_token}\"},\"requesttype\": \"DEBIT\",\"paymentref\": \"{$pending_payment->paymentref}\"}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
                    ),
                ));

                $status_response = curl_exec($curl);

                Log::info('status_response', [
                    'status_response' => $status_response
                ]);

                curl_close($curl);
                //end status check
                if ($status_response == "{}") {
                    return response()->json(array(
                        'wait_time' => $wait_time,
                    ));
                }
                $decoded_response = json_decode($status_response);

                if ($decoded_response->header->message == 'SUCCESS' && $decoded_response->header->status == '000') {
                    $aupdate_arr = ['status' => $decoded_response->transactionstatus];
                    if (isset($decoded_response->transactionstatusreason)) {
                        $aupdate_arr = $aupdate_arr + ['transactionstatusreason' => $decoded_response->transactionstatusreason];
                    }
                    $pending_payment->update(
                        $aupdate_arr
                    );
                    $pending_payment = Payment::find($pending_payment->paymentid);
                }


                if ($pending_payment->status == 'ACCEPTED' || $pending_payment->status == 'PENDING') {
                    return response()->json(array(
                        'wait_time' => $wait_time,
                    ));
                }

                if ($pending_payment->status == 'SUCCESS' || $pending_payment->status == 'SUCCESSFUL') {
                    if ($request->has('enrolmentid')) {
                        return response()->json(array(
                            'already_subscribed' => true,
                            'payment' => $payment,
                            'enrolment' => $enrolment
                        ));
                    } else {
                        $enrolments = Enrolment::where('studentid', '=', request('payerid'))
                            ->where('enrolled', '=', 1)
                            ->get();

                        $institution_enrolments = [];
                        foreach ($enrolments as $enrolment) {
                            Log::info('ser', [
                                'r' => $enrolment
                            ]);
                            if (InstructorCourse::find($enrolment->instructorcourseid)->institutionid == $institution->institutionid) {
                                $institution_enrolments[] = $enrolment;
                            }
                        }
                        return response()->json(array(
                            'already_subscribed' => true,
                            'payment' => $payment,
                            'institution' => $institution,
                            'institution_enrolments' => $institution_enrolments,
                        ));
                    }
                }

                $current_payment = $this->storePayment($request);
                return response()->json(array(
                    'current_payment' => $current_payment,
                    'prev_payment' => $pending_payment
                ));
            }
            return response()->json(array(
                'wait_time' => $wait_time,
            ));
        }
        $stored_payment = $this->storePayment($request);
        return response()->json(array(
            'stored_payment' => $stored_payment
        ));
    }

    public function pay(Request $request)
    {
        $paymentid = request('paymentid');
        $payment = Payment::where('paymentid', $paymentid)->first();

        $momo_api_client_id = env("MOMO_API_CLIENT_ID");
        $header['clientid'] = $momo_api_client_id;
        $header['countrycode'] = $payment->countrycode;
        $header['requestid'] = $paymentid;
        $momo_api_client_password = env("MOMO_API_CLIENT_PASSWORD");
        $header['token'] = hash('sha512', $paymentid . '' . $momo_api_client_id . '' . $momo_api_client_password . '');

        $body['header'] = $header;
        $body['msisdn'] = $payment->msisdn;
        $body['network'] = $payment->network;
        $body['description'] = "School Direct";
        $body['amount'] = (double)$payment->amount;
        $body['currency'] = $payment->currency;


        $curl = curl_init();

        $MOMO_API_BASE_URL = env("MOMO_API_BASE_URL");
        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$MOMO_API_BASE_URL}debitcustomer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"header\": {\"clientid\": \"uvstudent\",\"countrycode\": \"{$header['countrycode']}\",\"requestid\": \"{$header['requestid']}\",\"token\": \"{$header['token']}\"},\"msisdn\": \"{$body['msisdn']}\",\"network\": \"{$body['network']}\",\"description\": \"{$body['description']}\",\"amount\": {$body['amount']},\"currency\": \"{$body['currency']}\"}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        Log::info('debit_response', [
            'debit_response' => $response
        ]);

        curl_close($curl);
        $decoded_response = json_decode($response);
        $payment->update(
            [
                'message' => $decoded_response->header->message,
                'status' => $decoded_response->header->status,
                'externalreferenceno' => $decoded_response->externalreferenceno,
                'paymentref' => $decoded_response->paymentref,
            ]
        );

        $retrieved_payment = Payment::where('paymentid', $payment->paymentid)->first();

        return $retrieved_payment;
    }

    public function getRoom(Request $request)
    {
        $client = new Client();
        $CALL_API_BASE_URL = env("CALL_API_BASE_URL");
        $response = $client->createRequest(
            "GET",
            '' . $CALL_API_BASE_URL . 'api/v1/room');
        $contents = $client->send($response)->getBody()->getContents();


        $latest_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('expirydate')
            ->first();

        $latest_appuserfee_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('appuserfeeexpirydate')
            ->first();

        $expired = $latest_payment ? $latest_payment->expired : true;
        $appuserfeeexpired = $latest_appuserfee_payment ? $latest_appuserfee_payment->appuserfeeexpired : true;

        $instructorcourse = InstructorCourse::find(request('instructorcourseid'));
        $enrolment = Enrolment::find(request('enrolmentid'));

        $phonenumber = User::where('api_token', '=', $request->bearerToken())->first()->phonenumber;
        $client_whitelist = new Client();

        $eligible = false;
        if ($instructorcourse->institutionid != null && $instructorcourse->institutionid != "" && Institution::find($instructorcourse->institutionid)->internalinstitution == 1) {
            $eligible = !$enrolment->institutionfeeexpired;
        } else {
            $eligible = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        }

        $eligibility = $eligible ? "true" : "false";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . $CALL_API_BASE_URL . 'v2/participant/status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "{\"status\": \"$eligibility\",\"participant\": \"$phonenumber\"}",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json(array(
            'eligible' => $eligible,
            'intructorcourse' => $instructorcourse,
            'enrolment' => $enrolment,
            'contents' => $contents
        ));
    }

    public function checkSubscription(Request $request)
    {
        $latest_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('expirydate')
            ->first();

        $latest_appuserfee_payment = Payment::where('enrolmentid', '=', request('enrolmentid'))->latest('created_at')
            ->whereNotNull('appuserfeeexpirydate')
            ->first();

        $expired = $latest_payment ? $latest_payment->expired : true;
        $appuserfeeexpired = $latest_appuserfee_payment ? $latest_appuserfee_payment->appuserfeeexpired : true;

        $instructorcourse = InstructorCourse::find(request('instructorcourseid'));
        $enrolment = Enrolment::find(request('enrolmentid'));
        $classsession = ClassSession::where('instructorcourseid', '=', request('instructorcourseid'))->first();

        $eligible = false;
        if ($instructorcourse->institutionid != null && $instructorcourse->institutionid != "" && Institution::find($instructorcourse->institutionid)->internalinstitution == 1) {
            $eligible = !$enrolment->institutionfeeexpired;
        } else {
            $eligible = !$enrolment->enrolmentfeeexpired && !$enrolment->appuserfeeexpired;
        }

        return response()->json(array(
            'eligible' => $eligible,
            'intructorcourse' => $instructorcourse,
            'enrolment' => $enrolment
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return $payment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $bodyContent = $request->getContent();

        $payment->update(
            [
                'message' => $bodyContent->header->message,
                'status' => $bodyContent->header->status,
                'externalreferenceno' => $bodyContent->externalreferenceno,
                'paymentref' => $bodyContent->paymentref,
            ]
        );

        $payment->update($request->all());

        $updated_payment = Payment::where('paymentid', $payment->paymentid)->first();


        return response()->json($updated_payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function sendOtp()
    {
        $phonenumber = request('phonenumber');

        $user = User::where('phonenumber', $phonenumber)->first();

        $already_registered = false;
        if (!$user) {
            $already_registered = false;
            $userid = Str::uuid();
            $user = User::forceCreate([
                'userid' => $userid,
                'phonenumber' => $phonenumber,
                'role' => request('role'),
                'api_token' => Str::uuid()
            ]);
            if ($user->role == 'student') {
                Student::forceCreate([
                    'infoid' => $userid
                ]);
            } else if ($user->role == 'instructor') {
                Instructor::forceCreate([
                    'infoid' => $userid
                ]);
            }
        } else {
            $already_registered = true;
        }
        $hash = request('hash');
        $client = new Client();
        $otp = mt_rand(1000, 9999);
        $content = "<#> Your OTP is: $otp $hash";
        $content = urlencode($content);

        $user->update([
            'otp' => $otp
        ]);

        $CLICKATELL_API_KEY = env("CLICKATELL_API_KEY");
        $response = $client->createRequest(
            "GET",
            "https://platform.clickatell.com/messages/http/send?apiKey={$CLICKATELL_API_KEY}&to=$phonenumber&content=$content"
        );
        $contents = $client->send($response)->getBody()->getContents();
//        return $contents;
        return response()->json(array(
            'contents' => $contents,
            'userid' => $user->userid,
            'api_token' => $user->api_token,
            'already_registered' => $already_registered,
        ));
    }

    public function callback(Request $request)
    {
        Log::info('callback_request_params', [
            'callback_request_params' => $request
        ]);

        $payment = Payment::where('paymentref', request('paymentref'))
            ->where('externalreferenceno', '=', request('externalrefno'))
            ->first();

        if ($payment) {
            $payment->update(
                [
                    'paymentref' => request('paymentref'),
                    'externalreferenceno' => request('externalrefno'),
                    'status' => request('status')
                ]
            );

            if (request('status') == 'FAILED') {
                //Check status
                $curl = curl_init();
                $momo_api_client_id = env("MOMO_API_CLIENT_ID");
                $momo_api_client_password = env("MOMO_API_CLIENT_PASSWORD");
                $payment_token = hash('sha512', $payment->paymentid . $momo_api_client_id . $momo_api_client_password);
                $MOMO_API_BASE_URL = env("MOMO_API_BASE_URL");
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "{$MOMO_API_BASE_URL}transactionstatus",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"header\": {\"clientid\": \"uvstudent\",\"countrycode\": \"{$payment->countrycode}\",\"requestid\": \"{$payment->paymentid}\",\"token\": \"{$payment_token}\"},\"requesttype\": \"DEBIT\",\"paymentref\": \"{$payment->paymentref}\"}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
                    ),
                ));

                $status_response = curl_exec($curl);

                Log::info('status_response', [
                    'status_response' => $status_response
                ]);

                curl_close($curl);
                //end status check
                $decoded_response = json_decode($status_response);

                if ($decoded_response->header->message == 'SUCCESS' && $decoded_response->header->status == '000') {
                    $aupdate_arr = ['status' => $decoded_response->transactionstatus];
                    if (isset($decoded_response->transactionstatusreason)) {
                        $aupdate_arr = $aupdate_arr + ['transactionstatusreason' => $decoded_response->transactionstatusreason];
                    }
                    $payment->update(
                        $aupdate_arr
                    );
                }
            }
            /*// Notify instructor
            if (request('status') == 'SUCCESS' || request('status') == 'SUCCESSFUL') {
                $student_name = "{$payment->payer->title} {$payment->payer->firstname} {$payment->payer->lastname} {$payment->payer->othername}";
                $amount = "{$payment->currency}{$payment->amount}";
                $description = "{$payment->description}";
                $instructorCourse = InstructorCourse::find($payment->enrolment->instructorcourseid);
                $coursepath = $instructorCourse->course->coursepath;
                $registration_id = $instructorCourse->instructor->confirmation_token;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS =>"{\"notification\": {\"title\": \"Payment Made\",\"body\": \" Payment of {$amount} successfully received from {$student_name}\"},\"registration_ids\": [\"{$registration_id}\"]}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: key=AAAAdVbgHXQ:APA91bGFy3B1nmmHcCEjbal-ZRcR6AHmuEazFfMPO2UJ-xp1n1ZK9sueJq2KmRmIneEwp6rHtHMuUxPD5Uu9yS5i9yjqfpUQ7XXM-u3VBTnhAxdRGxrvleVfnZtfNjWSNnG5PGZ9RMox"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
            }*/
        }

        /*Log::info('payment_not_found', [
            'payment_not_found' => 'payment not found'
        ]);*/

        /*// Send callback response to meetings app backend
        $curl = curl_init();

        $paymentref = request('paymentref');
        $externalrefno = request('externalrefno');
        $status = request('status');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://41.189.178.40/meetings/api/payments/callback?paymentref={$paymentref}&externalrefno={$externalrefno}&status={$status}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));

        $response = curl_exec($curl);

        curl_close($curl);*/

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storePayment(Request $request)
    {
        $date_now = date_create(date('d-m-Y'));
        $expirydate = null;
        if (request('description') != '') {
            $split = explode(" ", request('description'));
            $duration = $split[count($split) - 1];
            switch ($duration) {
                case "day":
                    date_add($date_now, date_interval_create_from_date_string("1 day"));
                    $expirydate = date_format($date_now, "d-m-Y");
                    break;
                case "week":
                    date_add($date_now, date_interval_create_from_date_string("7 days"));
                    $expirydate = date_format($date_now, "d-m-Y");
                    break;
                case "month":
                    date_add($date_now, date_interval_create_from_date_string("30 days"));
                    $expirydate = date_format($date_now, "d-m-Y");
                    break;
            }
            $expirydate = date('Y-m-d', strtotime($expirydate));
        }

        $date_now = date_create(date('d-m-Y'));
        $appuserfeeexpirydate = null;
        if (request('appuserfeedescription') != null) {
            $appuserfeesplit = explode(" ", request('appuserfeedescription'));
            $appuserfeeduration = $appuserfeesplit[count($appuserfeesplit) - 1];
            switch ($appuserfeeduration) {
                case "day":
                    date_add($date_now, date_interval_create_from_date_string("1 day"));
                    $appuserfeeexpirydate = date_format($date_now, "d-m-Y");
                    break;
                case "week":
                    date_add($date_now, date_interval_create_from_date_string("7 days"));
                    $appuserfeeexpirydate = date_format($date_now, "d-m-Y");
                    break;
                case "month":
                    date_add($date_now, date_interval_create_from_date_string("30 days"));
                    $appuserfeeexpirydate = date_format($date_now, "d-m-Y");
                    break;
            }
            $appuserfeeexpirydate = date('Y-m-d', strtotime($appuserfeeexpirydate));
        }


        $paymentid = Str::uuid();
        Payment::forceCreate(
            [
                'paymentid' => $paymentid,
                'status' => "PENDING",
                'expirydate' => $request->has('enrolmentid') ? $expirydate : null,
                'institutionfeeexpirydate' => $request->has('institutionid') ? $expirydate : null,
                'appuserfeeexpirydate' => $appuserfeeexpirydate,
                'msisdn' => request('msisdn'),
                'countrycode' => request('countrycode'),
                'network' => request('network'),
                'currency' => request('currency'),
                'amount' => request('amount'),
                'description' => request('description'),
                'appuserfeedescription' => request('appuserfeedescription'),
                'payerid' => request('payerid'),
                'enrolmentid' => $request->has('enrolmentid') ? request('enrolmentid') : null,
                'institutionid' => $request->has('institutionid') ? request('institutionid') : null,
                'feetype' => $request->has('feetype') ? request('feetype') : null
            ]);
        $current_payment = Payment::where('paymentid', $paymentid)->first();
        return $current_payment;
    }

    public function renewInternalInstitutionSubscription(Request $request)
    {
        $institutionid = request('institutionid');

        $latest_payment = Payment::where('institutionid', '=', $institutionid)
            ->where('payerid', '=', request('userid'))
            ->whereNotNull('institutionfeeexpirydate')
            ->latest('created_at')
            ->first();

        $subscription_change_request = SubscriptionChangeRequest::where('institutionid', '=', $institutionid)
            ->where('studentid', '=', request('userid'))
            ->latest('created_at')
            ->first();

        $institution_fees = InstitutionFee::where('institutionid', '=', $institutionid)->get();

        return response()->json(array(
            'institution_fees' => $institution_fees,
            'updated_payment' => $latest_payment,
//            'subscription_change_request_approved' => $subscription_change_request ? $subscription_change_request->approved : 0
            'subscription_change_request_approved' => 1
        ));
    }
}
