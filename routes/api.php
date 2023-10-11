<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/create-user', 'UserController@createUser');
Route::post('/register', 'Auth\RegisterController@store');
Route::post('/login','Auth\LoginController@login');
Route::get('password/reset/{token}', 'Auth\RegisterController@resetPassword');

Route::post('/student-institution-login','StudentInstitutionLoginController@StudentInstitutionLogin')->middleware('auth:api');

//Route::resource('students', 'StudentController');
Route::get('/students', 'StudentController@index')->middleware('auth:api');
Route::get('/students/create', 'StudentController@create')->middleware('auth:api');
Route::get('/students/{student}', 'StudentController@show')->middleware('auth:api');
Route::post('/students', 'StudentController@store')->middleware('auth:api');
Route::get('/students/{student}/edit', 'StudentController@edit');
Route::post('/students/{student}', 'StudentController@update');
Route::patch('/update-confirmation-token/{student}', 'StudentController@updateConfirmationToken')->middleware('auth:api');
Route::get('/students/{student}', 'StudentController@destroy')->middleware('auth:api');

Route::resource('/assignments', 'AssignmentController')->middleware('auth:api');
Route::resource('/attendances', 'AttendanceController')->middleware('auth:api');
Route::resource('/audios', 'AudioController')->middleware('auth:api');
Route::resource('/chats', 'ChatController')->middleware('auth:api');
Route::resource('/live-chats', 'LiveChatController')->middleware('auth:api');
Route::post('/fetch-question', 'PastQuestionController@fetchQuestion')->middleware('auth:api');
Route::resource('/past-questions', 'PastQuestionController')->middleware('auth:api');
Route::post('/unique-years/', 'PastQuestionController@uniqueYears');
Route::resource('/recorded-streams', 'RecordedStreamController')->middleware('auth:api');
Route::resource('/recorded-video-streams', 'RecordedVideoStreamController')->middleware('auth:api');
Route::resource('/recorded-audio-streams', 'RecordedAudioStreamController')->middleware('auth:api');
//Route::resource('/notifications', 'NotificationController')->middleware('auth:api');
Route::resource('/courses', 'CourseController')->middleware('auth:api');
Route::resource('/enrolments', 'EnrolmentController')->middleware('auth:api');
Route::resource('/institutions', 'InstitutionController')->middleware('auth:api');
Route::resource('/instructors', 'InstructorController')->middleware('auth:api');
Route::resource('/instructor-courses', 'InstructorCourseController')->middleware('auth:api');
Route::resource('/instructor-course-institutions', 'InstructorCourseInstitutionController')->middleware('auth:api');
Route::resource('/payments', 'PaymentController')->middleware('auth:api');
Route::resource('/recommended-docs', 'RecommendedDocController')->middleware('auth:api');
//Route::resource('/students', 'StudentController')->middleware('auth:api');
Route::resource('/submitted-assignments', 'SubmittedAssignmentController')->middleware('auth:api');
Route::resource('/users', 'UserController')->middleware('auth:api');
Route::resource('/timetables', 'TimetableController')->middleware('auth:api');
Route::resource('/periods', 'PeriodController')->middleware('auth:api');
Route::resource('/instructor-course-periods', 'InstructorCoursePeriodController')->middleware('auth:api');
Route::resource('/instructor-course-ratings', 'InstructorCourseRatingController')->middleware('auth:api');
//Route::resource('/class-sessions', 'ClassSessionController')->middleware('auth:api');
Route::resource('/quizzes', 'QuizController')->middleware('auth:api');
Route::resource('/submitted-quizzes', 'SubmittedQuizController')->middleware('auth:api');
Route::resource('/enrolment-requests', 'EnrolmentRequestController')->middleware('auth:api');
Route::post('/subscription-change-request', 'SubscriptionChangeRequestController@requestSubscriptionChange')->middleware('auth:api');
Route::resource('/recorded-videos', 'RecordedVideoController')->middleware('auth:api');
Route::resource('/faqs', 'FaqController')->middleware('auth:api');

Route::post('/filtered-courses/', 'CourseController@filteredCourses');
Route::post('/sub-courses/', 'CourseController@subCourses');

Route::post('/course-instructors', 'InstructorCourseController@courseInstructors');

Route::post('/otp/send', 'UserController@sendOtp');
Route::post('/otp/get', 'UserController@getOtp')->middleware('auth:api');

Route::post('/confirm-registration', 'UserController@confirmRegistration');

Route::post('/payments/pay', 'PaymentController@pay');

Route::get('/all-data', 'UserController@fetchAll')->middleware('auth:api');

Route::get('/generate-pin', 'UserController@generatePin')->middleware('auth:api');

Route::get('/enrolment-refresh-data', 'UserController@fetchEnrolmentRefreshData')->middleware('auth:api');

Route::get('/recorded-streams-refresh-data', 'UserController@fetchRecordedStreamsRefreshData')->middleware('auth:api');

Route::get('/assignments-refresh-data', 'UserController@fetchAssignmentsRefreshData')->middleware('auth:api');

Route::get('/docs-refresh-data', 'UserController@fetchDocsRefreshData')->middleware('auth:api');

Route::get('/quizzes-refresh-data', 'UserController@fetchQuizzesRefreshData')->middleware('auth:api');

Route::post('/live-class-refresh-data', 'UserController@fetchLiveClassRefreshData')->middleware('auth:api');

Route::post('/payment-refresh-data', 'UserController@fetchPaymentRefreshData')->middleware('auth:api');

Route::get('/attendance-refresh-data', 'UserController@fetchAttendanceRefreshData')->middleware('auth:api');

Route::post('/instructor-course-students', 'InstructorCourseController@students')->middleware('auth:api');

Route::post('/room', 'PaymentController@getRoom')->middleware('auth:api');

Route::post('/live-classes', 'ClassSessionController@getLiveClass')->middleware('auth:api');

Route::post('/live-class-videos', 'ClassVideoSessionController@getLiveVideoClass')->middleware('auth:api');

Route::post('/live-class-audios', 'ClassAudioSessionController@getLiveAudioClass')->middleware('auth:api');

Route::post('/check-subscription', 'PaymentController@checkSubscription')->middleware('auth:api');

Route::post('/payments/callback', 'PaymentController@callback');

Route::resource('/drawing-coordinates', 'DrawingCoordinateController')->middleware('auth:api');
Route::post('/session-drawing-coordinates', 'DrawingCoordinateController@getSessionCoordinates')->middleware('auth:api');
Route::post('/class-video-session-refresh-data', 'ClassVideoSessionController@classSessionRefreshData')->middleware('auth:api');
Route::post('/class-audio-session-refresh-data', 'ClassAudioSessionController@classSessionRefreshData')->middleware('auth:api');
Route::post('/session-data', 'DrawingCoordinateController@getSessionData')->middleware('auth:api');
Route::post('/session-drawing-coordinates', 'DrawingCoordinateController@getSessionDrawingCoordinates')->middleware('auth:api');
Route::get('/version-guid-check', 'UserController@versionGuidCheck')->middleware('auth:api');
Route::post('/renew-internal-institution-subscription', 'PaymentController@renewInternalInstitutionSubscription')->middleware('auth:api');
Route::get('/student-project-info', 'StudentProjectInfoController@index')->middleware('auth:api');
Route::post('/bulk-unenrol', 'EnrolmentController@bulkUnenrol');
//Auth::routes(['verify' => true]);

