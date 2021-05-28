<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *****************************************************************************
 **************************** PATIENT ROUTES *********************************
 *****************************************************************************
 */

Route::group(['prefix' => 'patient', 'middleware' => ['assign.guard:patient']], function () {
    Route::post('/signUp', 'API\Patient\AuthController@patientSignUp');
    Route::post('/signIn', 'API\Patient\AuthController@patientSignIn');
    Route::post('/forgotPassword', 'API\Patient\AuthController@forgotPassword');

    Route::post('/getAllAllergies', 'API\Patient\PatientController@getAllAllergies');
    Route::post('/getAllDurgs', 'API\Patient\PatientController@getAllDurgs');
    Route::post('/getAllPractitioners', 'API\Patient\PatientController@getAllPractitioners');
    Route::post('/getAllSpecialties', 'API\Patient\PatientController@getAllSpecialties');

    Route::post('/getClinics', 'API\Patient\AppointmentController@getClinics');
    Route::post('/getPractitionerFee', 'API\Patient\AppointmentController@getPractitionerFee');
    Route::post('/getTimeSlots', 'API\Patient\AppointmentController@getTimeSlots');

    Route::middleware(['jwt.auth', 'jwt.verifyClaim'])->group(function () {
        Route::post('/dashboard', 'API\Patient\PatientController@dashboard');
        Route::post('/getProfile', 'API\Patient\PatientController@getMyProfile');
        Route::post('/updateProfileData', 'API\Patient\PatientController@updateProfile');
        Route::post('/postEditProfile', 'API\Patient\PatientController@postEditProfile');
        Route::post('/addAttachment', 'API\Patient\PatientController@addAttachment');
        Route::post('/deleteAttachment', 'API\Patient\PatientController@deleteAttachment');

        Route::post('/getNotifications', 'API\Patient\PatientController@getNotifications');
        Route::post('/notificationDelete', 'API\Patient\PatientController@notificationDelete');

        Route::post('/logout', 'API\Patient\AuthController@logout');

        //        PAYMENT APIS
        Route::post('/getPaymentList', 'API\Patient\PatientController@getPaymentList');

        //        PRACTITIONERS APIS
        Route::post('/getAllPractitionersList', 'API\Patient\PatientController@getAllPractitionersList');
        Route::post('/practitionerDetails', 'API\Patient\PatientController@practitionerDetails');

        //        APPOINTMENT APIS
        Route::post('/getAppointments', 'API\Patient\AppointmentController@getAppointments');
        Route::post('/createAppointment', 'API\Patient\AppointmentController@createAppointment');
        Route::post('/editAppointment', 'API\Patient\AppointmentController@editAppointment');
        Route::post('/updateAppointment', 'API\Patient\AppointmentController@updateAppointment');

        //      Patient Previous Visits APIS
        Route::post('/getPatientPreviousVisits', 'API\Patient\PatientVisitController@patientPreviousVisits');
        Route::post('/patientPreviousVisitDetail', 'API\Patient\PatientVisitController@patientPreviousVisitDetail');
    });
});


/**
 *****************************************************************************
 ************************** PRACTITIONER ROUTES ******************************
 *****************************************************************************
 */

Route::group(['prefix' => 'practitioner', 'middleware' => ['assign.guard:practitioner']], function () {
    Route::post('/signUp', 'API\Practitioner\AuthController@practitionerSignUp');
    Route::post('/signIn', 'API\Practitioner\AuthController@practitionerSignIn');
    Route::post('/forgotPassword', 'API\Practitioner\AuthController@forgotPassword');

    Route::post('/getAllQualifications', 'API\Practitioner\PractitionerController@getAllQualifications');
    Route::post('/getAllClinics', 'API\Practitioner\PractitionerController@getAllClinics');



    Route::post('/getClinics', 'API\Practitioner\AppointmentController@getClinics');
    Route::post('/getPractitionerFee', 'API\Practitioner\AppointmentController@getPractitionerFee');
    Route::post('/getTimeSlots', 'API\Practitioner\AppointmentController@getTimeSlots');

    Route::middleware(['jwt.auth', 'jwt.verifyClaim'])->group(function () {
        Route::post('/getProfile', 'API\Practitioner\PatientController@getMyProfile');
        Route::post('/updateProfileData', 'API\Practitioner\PatientController@updateProfile');
        Route::post('/postEditProfile', 'API\Practitioner\PatientController@postEditProfile');
        Route::post('/addAttachment', 'API\Practitioner\PatientController@addAttachment');
        Route::post('/deleteAttachment', 'API\Practitioner\PatientController@deleteAttachment');

        Route::post('/logout', 'API\Practitioner\AuthController@logout');

        //        PAYMENT APIS
        Route::post('/getPaymentList', 'API\Practitioner\PatientController@getPaymentList');

        //        PRACTITIONERS APIS
        Route::post('/getAllPractitionersList', 'API\Practitioner\PatientController@getAllPractitionersList');

        //        APPOINTMENT APIS
        Route::post('/getAppointments', 'API\Practitioner\AppointmentController@getAppointments');
        Route::post('/createAppointment', 'API\Practitioner\AppointmentController@createAppointment');
        Route::post('/editAppointment', 'API\Practitioner\AppointmentController@editAppointment');
        Route::post('/updateAppointment', 'API\Practitioner\AppointmentController@updateAppointment');

        //      Patient Previous Visits APIS
        Route::post('/getPatientPreviousVisits', 'API\Practitioner\PatientVisitController@patientPreviousVisits');
        Route::post('/patientPreviousVisitDetail', 'API\Practitioner\PatientVisitController@patientPreviousVisitDetail');
    });
});
