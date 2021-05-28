<?php

// Frontend Routes
Route::get('/joinAppointment/{patientId}/{practitionerId}/{appointmentId}', 'HomeController@joinAppointment')->name('joinAppointment');
Route::get('/checkIn/{otp}/{appointmentId}', 'HomeController@checkIn')->name('patientCheckIn');
Route::get('/checkAppointmentStatus/{appointmentId}', 'HomeController@checkAppointmentStatus')->name('checkAppointmentStatus');
Route::get('/changeAppointmentStatusBit/{appointmentId}', 'HomeController@changeAppointmentStatusBit')->name('changeAppointmentStatusBit');
Route::get('/', 'Frontend\FrontendController@indexPage')->name('indexPage');
Route::get('/list-facilities', 'Frontend\FrontendController@facilitiesPage')->name('facilitiesPage');
// Route::get('/list-clinics', 'Frontend\FrontendController@clinicsPage')->name('clinicsPage');
Route::get('/list-doctors', 'Frontend\FrontendController@doctorsPage')->name('doctorsPage');
// Route::post('/search-clinics', 'Frontend\FrontendController@clinicSearch')->name('clinicSearch');
Route::post('/search-doctors', 'Frontend\FrontendController@doctorSearch')->name('doctorSearch');
Route::get('/doctor-profile/{id}', 'Frontend\FrontendController@doctorProfilePage')->name('doctorProfilePage');
// Route::get('/clinic-profile/{id}', 'Frontend\FrontendController@clinicProfilePage')->name('clinicProfilePage');



// Patient Appointment Reminder
Route::get('/patient-appointment-reminder', 'Practitioner\AppointmentController@patientAppointmentReminder')->name('patientAppointmentReminder');

// Home Screen For Logins/Registers
Route::get('/site-logins', 'HomeController@index')->name('homeScreen');
Route::get('/agoraTokenGenerate', 'HomeController@agoraTokenGenerate');
Route::get('/sendAllAppointmentNotifications', 'HomeController@sendAllAppointmentNotifications');
Route::get('/invoice', 'HomeController@invoice');

// Insert Data
Route::get('/data-entry', 'DataEntryController@index')->name('insertDataForm');
Route::post('/insert/data', 'DataEntryController@importExcel')->name('insertData');


// patient LOGIN ROUTES

Route::get('/patient/login', 'Patient\LoginController@loginForm')->name('patientLoginForm');
Route::get('/patient/register', 'Patient\LoginController@registerForm')->name('patientRegisterForm');
Route::post('/patient/register', 'Patient\LoginController@register')->name('patientRegister');
Route::post('/patient/login', 'Patient\LoginController@login')->name('patientLogin');

//Patient password reset routes
Route::get('patient/password-reset', 'Patient\LoginController@passwordForgotForm')->name('patientPasswordForgotForm');
Route::post('patient/forget-password', 'Patient\LoginController@passwordForgotEmail')->name('patientPasswordForgotEmail');
Route::get('/patient/password/reset/{token}', 'Auth\PatientResetPasswordController@showResetForm')->name('patientPasswordReset');
Route::post('/patient/password/reset/', 'Auth\PatientResetPasswordController@reset')->name('resetPasswordPatient');


Route::middleware(['patient'])->group(function () {

    Route::prefix('patient')->group(function () {

        // patient Notification Route
        Route::prefix('notification')->group(function () {
            Route::get('/detail/{id}', 'Patient\PatientController@notificationDetail')->name('patientNotificationDetail');
        });

        // PAtient Logout Route
        Route::post('/logout', 'Patient\LoginController@patientLogout')->name('patientLogout');

        // PAtient Dashboard Route
        Route::get('/dashboard', 'Patient\PatientController@index')->name('patientDashboard');

        // PAtient Profile Edit Route
        Route::prefix('profile')->group(function () {
            Route::get('/edit', 'Patient\PatientController@editProfile')->name('patientEditProfile');
            Route::post('/update', 'Patient\PatientController@updateProfile')->name('patientUpdateProfile');
        });

        // PAtient Doctors Route
        Route::prefix('practitioner')->group(function () {
            Route::get('/list', 'Patient\PatientController@practitionerList')->name('patientPractitionerList');
            Route::post('/list-search', 'Patient\PatientController@practitionerListSearch')->name('patientPractitionerListSearch');
            Route::get('/profile/{id}', 'Patient\PatientController@practitionerProfile')->name('patientPractitionerProfile');

        });

        // PAtient Data Edit Route
        Route::prefix('data')->group(function () {
            Route::get('/edit', 'Patient\PatientController@editData')->name('patientEditData');
            Route::post('/update', 'Patient\PatientController@updateData')->name('patientUpdateData');
            Route::post('/delete-report', 'Patient\PatientController@deleteReport')->name('byPatientReportDelete');

        });

        // Previous Visits Route
        Route::prefix('previous-visits')->group(function () {
            Route::get('/list', 'Patient\PatientController@patientPreviousVisits')->name('patientPreviousVisitsList');
            Route::get('/detail/{id}', 'Patient\PatientController@patientPreviousVisitDetail')->name('patientPreviousVisitDetailInPatient');
        });

        // Payment CRUD Route
        Route::prefix('payment')->group(function () {
            Route::get('/list', 'Patient\PaymentController@index')->name('patientPaymentList');
        });

        // Appointment CRUD Route
        Route::prefix('appointment')->group(function () {
            Route::get('/list/today-all', 'Patient\AppointmentController@todayAppointment')->name('patientTodayAppointment');

            Route::get('/list', 'Patient\AppointmentController@index')->name('patientAppointmentList');
            Route::get('/create', 'Patient\AppointmentController@create')->name('patientAppointmentCreate');
            Route::post('/store', 'Patient\AppointmentController@store')->name('patientAppointmentStore');
            Route::get('/edit/{id}', 'Patient\AppointmentController@edit')->name('patientAppointmentEdit');
            Route::post('/update', 'Patient\AppointmentController@update')->name('patientAppointmentUpdate');
            Route::post('/getClinics', 'Patient\AppointmentController@getClinics')->name('patientGetClinics');
            Route::post('/getTimeSlots', 'Patient\AppointmentController@getTimeSlots')->name('patientGetTimeSlots');
            Route::post('/getPractitionerPatientFee', 'Patient\AppointmentController@getPractitionerPatientFee')->name('getPractitionerPatientFee');
        });

        Route::get('/submitPayment/{id}', 'Patient\AppointmentController@submitPayment')->name('submitPayment');
        Route::get('/back-payment', 'Patient\AppointmentController@backPayment')->name('backPayment');

    });

});

// Assistant LOGIN ROUTES
Route::get('/assistant/login', 'Assistant\LoginController@loginForm')->name('assistantLoginForm');
Route::get('/assistant/register', 'Assistant\LoginController@registerForm')->name('assistantRegisterForm');
Route::post('/assistant/register', 'Assistant\LoginController@register')->name('assistantRegister');
Route::post('/assistant/login', 'Assistant\LoginController@login')->name('assistantLogin');

//Assistant password reset routes
Route::get('assistant/password-reset', 'Assistant\LoginController@passwordForgotForm')->name('assistantPasswordForgotForm');
Route::post('assistant/forget-password', 'Assistant\LoginController@passwordForgotEmail')->name('assistantPasswordForgotEmail');
Route::get('/assistant/password/reset/{token}', 'Auth\AssistantResetPasswordController@showResetForm')->name('assistantPasswordReset');
Route::post('/assistant/password/reset/', 'Auth\AssistantResetPasswordController@reset')->name('resetPasswordAssistant');

Route::middleware(['assistant'])->group(function () {

    Route::prefix('assistant')->group(function () {

        // practitioner Notification Route
        Route::prefix('notification')->group(function () {
            Route::get('/detail/{id}', 'Assistant\AssistantController@notificationDetail')->name('assistantNotificationDetail');
        });

        // Practitioner Logout Route
        Route::post('/logout', 'Assistant\LoginController@assistantLogout')->name('assistantLogout');

        // Practitioner Dashboard Route
        Route::get('/assistant-dashboard', 'Assistant\AssistantController@index')->name('assistantDashboard');

        // Check Patient Status
        Route::get('/checkPatientStatus', 'Assistant\AppointmentController@checkPatientStatus')->name('checkPatientStatus');
        Route::get('/joinAppointmentAssistant/{id}', 'Assistant\AssistantController@joinAppointment')->name('assistantJoinAppointment');

        Route::prefix('patient-visit')->group(function () {
            Route::get('/view/{patientId}/{appointmentId}/{practitionerId}', 'Assistant\PatientVisitController@manageAppointment')->name('manageAssistantAppointment');
            Route::post('/physicalExamsModelPost', 'Assistant\PatientVisitController@physicalExamsModelPost')->name('physicalExamsModelPostAssistant');
            Route::post('/patientHistoryModelPost', 'Assistant\PatientVisitController@patientHistoryModelPost')->name('patientHistoryModelPostAssistant');
            Route::post('/rosModelPost', 'Assistant\PatientVisitController@rosModelPost')->name('rosModelPostAssistant');
            Route::post('/pastMedicalHistoriesModelPost', 'Assistant\PatientVisitController@pastMedicalHistoriesModelPost')->name('pastMedicalHistoriesModelPostAssistant');
            Route::post('/pastSurgicalHistoriesModelPost', 'Assistant\PatientVisitController@pastSurgicalHistoriesModelPost')->name('pastSurgicalHistoriesModelPostAssistant');
            Route::post('/familyMedicalHistoriesModelPost', 'Assistant\PatientVisitController@familyMedicalHistoriesModelPost')->name('familyMedicalHistoriesModelPostAssistant');
            Route::post('/get-reactions-list', 'Assistant\PatientVisitController@getReactionslist')->name('getReactionslistAssistant');
            Route::post('/adrModelPost', 'Assistant\PatientVisitController@adrModelPost')->name('adrModelPostAssistant');
            Route::post('/getPresciptionTemplate', 'Assistant\PatientVisitController@getPresciptionTemplate')->name('getPresciptionTemplateAssistant');
            Route::post('/submitVisitPresciptionTemplateNOte', 'Assistant\PatientVisitController@submitVisitPresciptionTemplateNOte')->name('submitVisitPresciptionTemplateNOteAssistant');
            Route::post('/updatePatientStatusOnVisit', 'Assistant\PatientVisitController@updatePatientStatusOnVisit')->name('updatePatientStatusOnVisitAssistant');
            Route::post('/savePatientReferalDoctor', 'Assistant\PatientVisitController@savePatientReferalDoctor')->name('savePatientReferalDoctorAssistant');
            Route::post('/saveNextVisit', 'Assistant\PatientVisitController@saveNextVisit')->name('saveNextVisitAssistant');
            Route::post('/rxMedicinesModelPost', 'Assistant\PatientVisitController@rxMedicinesModelPost')->name('rxMedicinesModelPostAssistant');
            Route::post('/smokingModelPost', 'Assistant\PatientVisitController@smokingModelPost')->name('smokingModelPostAssistant');
            Route::post('/getRXMedicineFieldsValues', 'Assistant\PatientVisitController@getRXMedicineFieldsValues')->name('getRXMedicineFieldsValuesAssistant');
            Route::post('/bpSysPatientVisit', 'Assistant\PatientVisitController@bpSysPatientVisit')->name('bpSysPatientVisitAssistant');
            Route::post('/bpDiasPatientVisit', 'Assistant\PatientVisitController@bpDiasPatientVisit')->name('bpDiasPatientVisitAssistant');
            Route::post('/pulsePatientVisit', 'Assistant\PatientVisitController@pulsePatientVisit')->name('pulsePatientVisitAssistant');
            Route::post('/weightLbsPatientVisit', 'Assistant\PatientVisitController@weightLbsPatientVisit')->name('weightLbsPatientVisitAssistant');
            Route::post('/weightKgsPatientVisit', 'Assistant\PatientVisitController@weightKgsPatientVisit')->name('weightKgsPatientVisitAssistant');
            Route::post('/heightFtPatientVisit', 'Assistant\PatientVisitController@heightFtPatientVisit')->name('heightFtPatientVisitAssistant');
            Route::post('/heightInPatientVisit', 'Assistant\PatientVisitController@heightInPatientVisit')->name('heightInPatientVisitAssistant');
            Route::post('/heightCmsPatientVisit', 'Assistant\PatientVisitController@heightCmsPatientVisit')->name('heightCmsPatientVisitAssistant');
            Route::post('/bpSys2PatientVisit', 'Assistant\PatientVisitController@bpSys2PatientVisit')->name('bpSys2PatientVisitAssistant');
            Route::post('/bpDias2PatientVisit', 'Assistant\PatientVisitController@bpDias2PatientVisit')->name('bpDias2PatientVisitAssistant');
            Route::post('/pulse2PatientVisit', 'Assistant\PatientVisitController@pulse2PatientVisit')->name('pulse2PatientVisitAssistant');
            Route::post('/weightLbs2PatientVisit', 'Assistant\PatientVisitController@weightLbs2PatientVisit')->name('weightLbs2PatientVisitAssistant');
            Route::post('/weightKgs2PatientVisit', 'Assistant\PatientVisitController@weightKgs2PatientVisit')->name('weightKgs2PatientVisitAssistant');
            Route::post('/heightFt2PatientVisit', 'Assistant\PatientVisitController@heightFt2PatientVisit')->name('heightFt2PatientVisitAssistant');
            Route::post('/heightIn2PatientVisit', 'Assistant\PatientVisitController@heightIn2PatientVisit')->name('heightIn2PatientVisitAssistant');
            Route::post('/heightCms2PatientVisit', 'Assistant\PatientVisitController@heightCms2PatientVisit')->name('heightCms2PatientVisitAssistant');
            Route::post('/saveLabTestPatientVisit', 'Assistant\PatientVisitController@saveLabTestPatientVisit')->name('saveLabTestPatientVisitAssistant');
            Route::post('/deleteLabTestPatientVisit', 'Assistant\PatientVisitController@deleteLabTestPatientVisit')->name('deleteLabTestPatientVisitAssistant');
            Route::post('/updatePatientLabTestModelPost', 'Assistant\PatientVisitController@updatePatientLabTestModelPost')->name('updatePatientLabTestModelPostAssistant');
            Route::post('/doctorNoteInternalPatientVisit', 'Assistant\PatientVisitController@doctorNoteInternalPatientVisit')->name('doctorNoteInternalPatientVisitAssistant');
            Route::post('/doctorNotePrintedPatientVisit', 'Assistant\PatientVisitController@doctorNotePrintedPatientVisit')->name('doctorNotePrintedPatientVisitAssistant');
            Route::post('/saveVisitPresciptionTemplate', 'Assistant\PatientVisitController@saveVisitPresciptionTemplate')->name('saveVisitPresciptionTemplateAssistant');
            Route::post('/bsfPatientVisit', 'Assistant\PatientVisitController@bsfPatientVisit')->name('bsfPatientVisitAssistant');
            Route::post('/bsf2PatientVisit', 'Assistant\PatientVisitController@bsf2PatientVisit')->name('bsf2PatientVisitAssistant');
            Route::post('/bsrPatientVisit', 'Assistant\PatientVisitController@bsrPatientVisit')->name('bsrPatientVisitAssistant');
            Route::post('/bsr2PatientVisit', 'Assistant\PatientVisitController@bsr2PatientVisit')->name('bsr2PatientVisitAssistant');
            Route::post('/checkSugarChart', 'Assistant\PatientVisitController@checkSugarChart')->name('checkSugarChartAssistant');
            Route::post('/unCheckSugarChart', 'Assistant\PatientVisitController@checkSugarChart')->name('unCheckSugarChartAssistant');
            Route::post('/patientEditProfileModelPost', 'Assistant\PatientVisitController@patientEditProfileModelPost')->name('patientEditProfileModelPostAssistant');
            Route::post('/patientReportUploadModelPost', 'Assistant\PatientVisitController@patientReportUploadModelPost')->name('patientReportUploadModelPostAssistant');
            Route::post('/getPreviousVisitDetails', 'Assistant\PatientVisitController@getPreviousVisitDetails')->name('getPreviousVisitDetailsAssistant');
            Route::post('/savePreviousVisitDetails', 'Assistant\PatientVisitController@savePreviousVisitDetails')->name('savePreviousVisitDetailsAssistant');
            Route::post('/revisePatientVisit', 'Assistant\PatientVisitController@revisePatientVisit')->name('revisePatientVisitAssistant');
            Route::post('/saveDurationVisit', 'Assistant\PatientVisitController@saveDurationVisit')->name('saveDurationVisitAssistant');
            Route::get('/report-send-to-patient/{patientId}/{appointmentId}/{practitionerId}', 'Assistant\PatientVisitController@sendToPatientReport')->name('sendToPatientReportAssistant');
            Route::get('/patient-report-preview/{patientId}/{appointmentId}/{practitionerId}', 'Assistant\PatientVisitController@patientReportPreview')->name('patientReportPreviewAssistant');
            Route::get('/send-sms-on-visit/{patientVisitId}', 'Assistant\PatientVisitController@sendSMSOnVisit')->name('sendSMSOnVisitAssistant');
        });

        // Practitioner Profile Edit Route
        Route::prefix('profile')->group(function () {
            Route::get('/edit', 'Assistant\AssistantController@editProfile')->name('assistantEditProfile');
            Route::post('/update', 'Assistant\AssistantController@updateProfile')->name('assistantUpdateProfile');
            Route::get('/change-password', 'Assistant\AssistantController@changePassword')->name('assistantChangePassword');
            Route::post('/update-change-password', 'Assistant\AssistantController@updateChangePassword')->name('assistantUpdateChangePassword');
        });

        // Practitioner Assistant Route
        Route::prefix('practitioner')->group(function () {
            Route::get('/list', 'Assistant\PractitionerController@index')->name('assistantPractitionerList');
            Route::get('/detail/{id}', 'Assistant\PractitionerController@detail')->name('assistantPractitionerDetail');
        });

        // Practitioner Data Edit Route
        Route::prefix('data')->group(function () {
            Route::get('/edit', 'Assistant\PractitionerController@editData')->name('assistantEditData');
            Route::post('/update', 'Assistant\PractitionerController@updateData')->name('assistantUpdateData');
        });

        // Patient CRUD Route
        Route::prefix('patient')->group(function () {
            Route::get('/list', 'Assistant\PatientController@index')->name('assistantPatientList');
            Route::get('/create/{fromAppointment?}', 'Assistant\PatientController@create')->name('assistantPatientCreate');
            Route::post('/store', 'Assistant\PatientController@store')->name('assistantPatientStore');
            Route::get('/edit/{id}', 'Assistant\PatientController@edit')->name('assistantPatientEdit');
            Route::post('/update', 'Assistant\PatientController@update')->name('assistantPatientUpdate');
            Route::post('/delete-report', 'Assistant\PatientController@deleteReport')->name('assistantPatientReportDelete');
            Route::get('/set-appointment/{id}', 'Assistant\PatientController@setAppointment')->name('assistantPatientAppointment');
            Route::get('/detail/{id}', 'Assistant\PatientController@detail')->name('assistantPatientDetail');
            Route::get('/previous-visits/{id}', 'Assistant\PatientController@patientPreviousVisits')->name('assistantPatientPreviousVisits');
            Route::get('/previous-visits-detail/{id}', 'Assistant\PatientController@patientPreviousVisitDetail')->name('assistantPatientPreviousVisitDetail');


            // Prescription CRUD Route
            Route::prefix('prescription')->group(function () {
                Route::get('/list/{id}', 'Assistant\PrescriptionController@index')->name('assistantPrescriptionList');
                Route::get('/create/{id}', 'Assistant\PrescriptionController@create')->name('assistantPrescriptionCreate');
                Route::post('/store', 'Assistant\PrescriptionController@store')->name('assistantPrescriptionStore');
                Route::get('/edit/{id}', 'Assistant\PrescriptionController@edit')->name('assistantPrescriptionEdit');
                Route::post('/update', 'Assistant\PrescriptionController@update')->name('assistantPrescriptionUpdate');
            });

        });

        // Appointment CRUD Route
        Route::prefix('appointment')->group(function () {
            Route::get('/list/today-all', 'Assistant\AppointmentController@todayAppointment')->name('assistantTodayAppointment');
            Route::get('/list/today-open', 'Assistant\AppointmentController@todayOpenAppointment')->name('assistantTodayOpenAppointment');
            Route::get('/list/today-closed', 'Assistant\AppointmentController@todayClosedAppointment')->name('assistantTodayClosedAppointment');

            Route::get('/list', 'Assistant\AppointmentController@index')->name('assistantAppointmentList');
            Route::get('/create', 'Assistant\AppointmentController@create')->name('assistantAppointmentCreate');
            Route::post('/store', 'Assistant\AppointmentController@store')->name('assistantAppointmentStore');
            Route::get('/edit/{id}', 'Assistant\AppointmentController@edit')->name('assistantAppointmentEdit');
            Route::post('/update', 'Assistant\AppointmentController@update')->name('assistantAppointmentUpdate');
            Route::post('/getClinics', 'Assistant\AppointmentController@getClinics')->name('assistantGetClinics');
            Route::post('/getTimeSlots', 'Assistant\AppointmentController@getTimeSlots')->name('assistantGetTimeSlots');
            Route::get('/startEarly/{id}', 'Assistant\AppointmentController@startEarly')->name('assistantstartEarly');
            Route::post('/getAssistantFee', 'Assistant\AppointmentController@getAssistantFee')->name('getAssistantFee');
        });

        // Prescription Template CRUD Route
        Route::prefix('prescription-template')->group(function () {
            Route::get('/', 'Assistant\PrescriptionTemplateController@index')->name('assistantPrescriptionTemplateList');
            Route::get('/create', 'Assistant\PrescriptionTemplateController@create')->name('assistantPrescriptionTemplateCreate');
            Route::post('/store', 'Assistant\PrescriptionTemplateController@store')->name('assistantPrescriptionTemplateStore');
            Route::get('/edit/{id}', 'Assistant\PrescriptionTemplateController@edit')->name('assistantPrescriptionTemplateEdit');
            Route::post('/update', 'Assistant\PrescriptionTemplateController@update')->name('assistantPrescriptionTemplateUpdate');
            Route::post('/delete', 'Assistant\PrescriptionTemplateController@delete')->name('assistantPrescriptionTemplateDelete');
        });

        // Payment CRUD Route
        Route::prefix('payment')->group(function () {
            Route::get('/', 'Assistant\PaymentController@index')->name('assistantPaymentList');
            Route::get('/edit/{id}', 'Assistant\PaymentController@edit')->name('assistantPaymentEdit');
            Route::post('/update', 'Assistant\PaymentController@update')->name('assistantPaymentUpdate');
            Route::get('/daily-report', 'Assistant\PaymentController@dailyReport')->name('dailyReportAssistant');

        });

        Route::prefix('lab-test')->group(function () {
            Route::get('/list', 'Assistant\LabTestController@index')->name('assistantLabTestList');
            Route::get('/create', 'Assistant\LabTestController@create')->name('assistantLabTestCreate');
            Route::post('/store', 'Assistant\LabTestController@store')->name('assistantLabTestStore');
            Route::post('/delete', 'Assistant\LabTestController@delete')->name('assistantLabTestDelete');
        });
    });

});


// Practitioner LOGIN ROUTES
Route::get('/practitioner/login', 'Practitioner\LoginController@loginForm')->name('practitionerLoginForm');
Route::get('/practitioner/register', 'Practitioner\LoginController@registerForm')->name('practitionerRegisterForm');
Route::post('/practitioner/register', 'Practitioner\LoginController@register')->name('practitionerRegister');
Route::post('/practitioner/login', 'Practitioner\LoginController@login')->name('practitionerLogin');

// Practitioner password reset routes
Route::get('practitioner/password-reset', 'Practitioner\LoginController@passwordForgotForm')->name('practitionerPasswordForgotForm');
Route::post('practitioner/forget-password', 'Practitioner\LoginController@passwordForgotEmail')->name('practitionerPasswordForgotEmail');
Route::get('/practitioner/password/reset/{token}', 'Auth\PractitionerResetPasswordController@showResetForm')->name('practitionerPasswordReset');
Route::post('/practitioner/password/reset/', 'Auth\PractitionerResetPasswordController@reset')->name('resetPasswordPractitioner');

Route::get('/show-pdf-ile/{file}', 'Practitioner\PatientVisitController@showPdfFile')->name('showPdfFile');

Route::middleware(['practitioner'])->group(function () {

    Route::prefix('practitioner')->group(function () {

        // practitioner Notification Route
        Route::prefix('notification')->group(function () {
            Route::get('/detail/{id}', 'Practitioner\PractitionerController@notificationDetail')->name('practitionerNotificationDetail');
        });

        // Practitioner Logout Route
        Route::post('/logout', 'Practitioner\LoginController@practitionerLogout')->name('practitionerLogout');

        // Check Patient Status
        Route::get('/checkPatientStatus', 'Practitioner\AppointmentController@checkPatientStatus')->name('checkPatientStatus');

        // Practitioner Dashboard Route
        Route::get('/dashboard', 'Practitioner\PractitionerController@index')->name('practitionerDashboard');
        Route::get('/joinAppointment/{id}', 'Practitioner\PractitionerController@joinAppointment')->name('practitionerJoinAppointment');


        Route::prefix('patient-visit')->group(function () {
            Route::get('/view/{patientId}/{appointmentId}/{practitionerId}', 'Practitioner\PatientVisitController@manageAppointment')->name('manageAppointment');
            Route::post('/physicalExamsModelPost', 'Practitioner\PatientVisitController@physicalExamsModelPost')->name('physicalExamsModelPost');
            Route::post('/patientHistoryModelPost', 'Practitioner\PatientVisitController@patientHistoryModelPost')->name('patientHistoryModelPost');
            Route::post('/rosModelPost', 'Practitioner\PatientVisitController@rosModelPost')->name('rosModelPost');
            Route::post('/pastMedicalHistoriesModelPost', 'Practitioner\PatientVisitController@pastMedicalHistoriesModelPost')->name('pastMedicalHistoriesModelPost');
            Route::post('/pastSurgicalHistoriesModelPost', 'Practitioner\PatientVisitController@pastSurgicalHistoriesModelPost')->name('pastSurgicalHistoriesModelPost');
            Route::post('/familyMedicalHistoriesModelPost', 'Practitioner\PatientVisitController@familyMedicalHistoriesModelPost')->name('familyMedicalHistoriesModelPost');
            Route::post('/get-reactions-list', 'Practitioner\PatientVisitController@getReactionslist')->name('getReactionslist');
            Route::post('/adrModelPost', 'Practitioner\PatientVisitController@adrModelPost')->name('adrModelPost');
            Route::post('/getPresciptionTemplate', 'Practitioner\PatientVisitController@getPresciptionTemplate')->name('getPresciptionTemplate');
            Route::post('/submitVisitPresciptionTemplateNOte', 'Practitioner\PatientVisitController@submitVisitPresciptionTemplateNOte')->name('submitVisitPresciptionTemplateNOte');
            Route::post('/updatePatientStatusOnVisit', 'Practitioner\PatientVisitController@updatePatientStatusOnVisit')->name('updatePatientStatusOnVisit');
            Route::post('/savePatientReferalDoctor', 'Practitioner\PatientVisitController@savePatientReferalDoctor')->name('savePatientReferalDoctor');
            Route::post('/saveNextVisit', 'Practitioner\PatientVisitController@saveNextVisit')->name('saveNextVisit');
            Route::post('/rxMedicinesModelPost', 'Practitioner\PatientVisitController@rxMedicinesModelPost')->name('rxMedicinesModelPost');
            Route::post('/smokingModelPost', 'Practitioner\PatientVisitController@smokingModelPost')->name('smokingModelPost');
            Route::post('/getRXMedicineFieldsValues', 'Practitioner\PatientVisitController@getRXMedicineFieldsValues')->name('getRXMedicineFieldsValues');
            Route::post('/bpSysPatientVisit', 'Practitioner\PatientVisitController@bpSysPatientVisit')->name('bpSysPatientVisit');
            Route::post('/bpDiasPatientVisit', 'Practitioner\PatientVisitController@bpDiasPatientVisit')->name('bpDiasPatientVisit');
            Route::post('/pulsePatientVisit', 'Practitioner\PatientVisitController@pulsePatientVisit')->name('pulsePatientVisit');
            Route::post('/weightLbsPatientVisit', 'Practitioner\PatientVisitController@weightLbsPatientVisit')->name('weightLbsPatientVisit');
            Route::post('/weightKgsPatientVisit', 'Practitioner\PatientVisitController@weightKgsPatientVisit')->name('weightKgsPatientVisit');
            Route::post('/heightFtPatientVisit', 'Practitioner\PatientVisitController@heightFtPatientVisit')->name('heightFtPatientVisit');
            Route::post('/heightInPatientVisit', 'Practitioner\PatientVisitController@heightInPatientVisit')->name('heightInPatientVisit');
            Route::post('/heightCmsPatientVisit', 'Practitioner\PatientVisitController@heightCmsPatientVisit')->name('heightCmsPatientVisit');
            Route::post('/bpSys2PatientVisit', 'Practitioner\PatientVisitController@bpSys2PatientVisit')->name('bpSys2PatientVisit');
            Route::post('/bpDias2PatientVisit', 'Practitioner\PatientVisitController@bpDias2PatientVisit')->name('bpDias2PatientVisit');
            Route::post('/pulse2PatientVisit', 'Practitioner\PatientVisitController@pulse2PatientVisit')->name('pulse2PatientVisit');
            Route::post('/weightLbs2PatientVisit', 'Practitioner\PatientVisitController@weightLbs2PatientVisit')->name('weightLbs2PatientVisit');
            Route::post('/weightKgs2PatientVisit', 'Practitioner\PatientVisitController@weightKgs2PatientVisit')->name('weightKgs2PatientVisit');
            Route::post('/heightFt2PatientVisit', 'Practitioner\PatientVisitController@heightFt2PatientVisit')->name('heightFt2PatientVisit');
            Route::post('/heightIn2PatientVisit', 'Practitioner\PatientVisitController@heightIn2PatientVisit')->name('heightIn2PatientVisit');
            Route::post('/heightCms2PatientVisit', 'Practitioner\PatientVisitController@heightCms2PatientVisit')->name('heightCms2PatientVisit');
            Route::post('/saveLabTestPatientVisit', 'Practitioner\PatientVisitController@saveLabTestPatientVisit')->name('saveLabTestPatientVisit');
            Route::post('/deleteLabTestPatientVisit', 'Practitioner\PatientVisitController@deleteLabTestPatientVisit')->name('deleteLabTestPatientVisit');
            Route::post('/updatePatientLabTestModelPost', 'Practitioner\PatientVisitController@updatePatientLabTestModelPost')->name('updatePatientLabTestModelPost');
            Route::post('/doctorNoteInternalPatientVisit', 'Practitioner\PatientVisitController@doctorNoteInternalPatientVisit')->name('doctorNoteInternalPatientVisit');
            Route::post('/doctorNotePrintedPatientVisit', 'Practitioner\PatientVisitController@doctorNotePrintedPatientVisit')->name('doctorNotePrintedPatientVisit');
            Route::post('/saveVisitPresciptionTemplate', 'Practitioner\PatientVisitController@saveVisitPresciptionTemplate')->name('saveVisitPresciptionTemplate');

            Route::post('/bsfPatientVisit', 'Practitioner\PatientVisitController@bsfPatientVisit')->name('bsfPatientVisit');
            Route::post('/bsf2PatientVisit', 'Practitioner\PatientVisitController@bsf2PatientVisit')->name('bsf2PatientVisit');
            Route::post('/bsrPatientVisit', 'Practitioner\PatientVisitController@bsrPatientVisit')->name('bsrPatientVisit');
            Route::post('/bsr2PatientVisit', 'Practitioner\PatientVisitController@bsr2PatientVisit')->name('bsr2PatientVisit');
            Route::post('/checkSugarChart', 'Practitioner\PatientVisitController@checkSugarChart')->name('checkSugarChart');
            Route::post('/unCheckSugarChart', 'Practitioner\PatientVisitController@checkSugarChart')->name('unCheckSugarChart');
            Route::post('/patientEditProfileModelPost', 'Practitioner\PatientVisitController@patientEditProfileModelPost')->name('patientEditProfileModelPost');
            Route::post('/patientReportUploadModelPost', 'Practitioner\PatientVisitController@patientReportUploadModelPost')->name('patientReportUploadModelPost');
            Route::post('/getPreviousVisitDetails', 'Practitioner\PatientVisitController@getPreviousVisitDetails')->name('getPreviousVisitDetails');
            Route::post('/savePreviousVisitDetails', 'Practitioner\PatientVisitController@savePreviousVisitDetails')->name('savePreviousVisitDetails');
            Route::post('/revisePatientVisit', 'Practitioner\PatientVisitController@revisePatientVisit')->name('revisePatientVisit');
            Route::post('/saveDurationVisit', 'Practitioner\PatientVisitController@saveDurationVisit')->name('saveDurationVisit');
            Route::get('/report-send-to-patient/{patientId}/{appointmentId}/{practitionerId}', 'Practitioner\PatientVisitController@sendToPatientReport')->name('sendToPatientReport');
            Route::get('/patient-report-preview/{patientId}/{appointmentId}/{practitionerId}', 'Practitioner\PatientVisitController@patientReportPreview')->name('patientReportPreview');
            Route::get('/send-sms-on-visit/{patientVisitId}', 'Practitioner\PatientVisitController@sendSMSOnVisit')->name('sendSMSOnVisit');
        });

        // Practitioner Profile Edit Route
        Route::prefix('profile')->group(function () {
            Route::get('/edit', 'Practitioner\PractitionerController@editProfile')->name('practitionerEditProfile');
            Route::post('/removeFilePractitioner', 'Practitioner\PractitionerController@removeFilePractitioner')->name('removeFilePractitioner');
            Route::post('/update', 'Practitioner\PractitionerController@updateProfile')->name('practitionerUpdateProfile');
            Route::get('/change-password', 'Practitioner\PractitionerController@changePassword')->name('practitionerChangePassword');
            Route::post('/update-change-password', 'Practitioner\PractitionerController@updateChangePassword')->name('practitionerUpdateChangePassword');
        });

        // Practitioner Clinic Route
        Route::prefix('practitioner')->group(function () {
            Route::get('/list', 'Practitioner\PractitionerController@clinicList')->name('practitionerClinicList');
            Route::get('/profile/{id}', 'Practitioner\PractitionerController@clinicProfile')->name('clinicProfile');

        });

        // Practitioner Data Edit Route
        Route::prefix('data')->group(function () {
            Route::get('/edit', 'Practitioner\PractitionerController@editData')->name('practitionerEditData');
            Route::post('/update', 'Practitioner\PractitionerController@updateData')->name('practitionerUpdateData');
        });

        // Patient CRUD Route
        Route::prefix('patient')->group(function () {
            Route::get('/list', 'Practitioner\PatientController@index')->name('practitionerPatientList');
            Route::get('/create/{fromAppointment?}', 'Practitioner\PatientController@create')->name('practitionerPatientCreate');
            Route::post('/store', 'Practitioner\PatientController@store')->name('practitionerPatientStore');
            Route::get('/edit/{id}', 'Practitioner\PatientController@edit')->name('practitionerPatientEdit');
            Route::post('/update', 'Practitioner\PatientController@update')->name('practitionerPatientUpdate');
            Route::post('/delete-report', 'Practitioner\PatientController@deleteReport')->name('practitionerPatientReportDelete');
            Route::get('/set-appointment/{id}', 'Practitioner\PatientController@setAppointment')->name('practitionerPatientAppointment');
            Route::get('/detail/{id}', 'Practitioner\PatientController@detail')->name('practitionerPatientDetail');
            Route::get('/previous-visits/{id}', 'Practitioner\PatientController@patientPreviousVisits')->name('practitionerPatientPreviousVisits');
            Route::get('/previous-visits-detail/{id}', 'Practitioner\PatientController@patientPreviousVisitDetail')->name('practitionerPatientPreviousVisitDetail');


            // Prescription CRUD Route
            Route::prefix('prescription')->group(function () {
                Route::get('/list/{id}', 'Practitioner\PrescriptionController@index')->name('practitionerPrescriptionList');
                Route::get('/create/{id}', 'Practitioner\PrescriptionController@create')->name('practitionerPrescriptionCreate');
                Route::post('/store', 'Practitioner\PrescriptionController@store')->name('practitionerPrescriptionStore');
                Route::get('/edit/{id}', 'Practitioner\PrescriptionController@edit')->name('practitionerPrescriptionEdit');
                Route::post('/update', 'Practitioner\PrescriptionController@update')->name('practitionerPrescriptionUpdate');

            });

        });

        // Practitioner Assistant Route
        Route::prefix('assistant')->group(function () {
            Route::get('/list', 'Practitioner\AssistantController@index')->name('practitionerAssistantList');
            Route::get('/detail/{id}', 'Practitioner\AssistantController@detail')->name('practitionerAssistantDetail');
        });

        // Appointment CRUD Route
        Route::prefix('appointment')->group(function () {
            Route::get('/list/today-all', 'Practitioner\AppointmentController@todayAppointment')->name('practitionerTodayAppointment');
            Route::get('/list/today-open', 'Practitioner\AppointmentController@todayOpenAppointment')->name('practitionerTodayOpenAppointment');
            Route::get('/list/today-closed', 'Practitioner\AppointmentController@todayClosedAppointment')->name('practitionerTodayClosedAppointment');

            Route::get('/list', 'Practitioner\AppointmentController@index')->name('practitionerAppointmentList');
            Route::get('/create', 'Practitioner\AppointmentController@create')->name('practitionerAppointmentCreate');
            Route::post('/store', 'Practitioner\AppointmentController@store')->name('practitionerAppointmentStore');
            Route::get('/edit/{id}', 'Practitioner\AppointmentController@edit')->name('practitionerAppointmentEdit');
            Route::post('/update', 'Practitioner\AppointmentController@update')->name('practitionerAppointmentUpdate');
            Route::post('/getClinics', 'Practitioner\AppointmentController@getClinics')->name('practitionerGetClinics');
            Route::post('/getTimeSlots', 'Practitioner\AppointmentController@getTimeSlots')->name('practitionerGetTimeSlots');
            Route::get('/startEarly/{id}', 'Practitioner\AppointmentController@startEarly')->name('practitionerstartEarly');
            Route::post('/getPractitionerFee', 'Practitioner\AppointmentController@getPractitionerFee')->name('getPractitionerFee');

        });

        // Prescription Template CRUD Route
        Route::prefix('prescription-template')->group(function () {
            Route::get('/', 'Practitioner\PrescriptionTemplateController@index')->name('practitionerPrescriptionTemplateList');
            Route::get('/create', 'Practitioner\PrescriptionTemplateController@create')->name('practitionerPrescriptionTemplateCreate');
            Route::post('/store', 'Practitioner\PrescriptionTemplateController@store')->name('practitionerPrescriptionTemplateStore');
            Route::get('/edit/{id}', 'Practitioner\PrescriptionTemplateController@edit')->name('practitionerPrescriptionTemplateEdit');
            Route::post('/update', 'Practitioner\PrescriptionTemplateController@update')->name('practitionerPrescriptionTemplateUpdate');
            Route::post('/delete', 'Practitioner\PrescriptionTemplateController@delete')->name('practitionerPrescriptionTemplateDelete');
        });

        // Payment CRUD Route
        Route::prefix('payment')->group(function () {
            Route::get('/', 'Practitioner\PaymentController@index')->name('practitionerPaymentList');
            Route::get('/edit/{id}', 'Practitioner\PaymentController@edit')->name('practitionerPaymentEdit');
            Route::post('/update', 'Practitioner\PaymentController@update')->name('practitionerPaymentUpdate');
            Route::get('/daily-report', 'Practitioner\PaymentController@dailyReport')->name('dailyReport');
        });
        Route::prefix('lab-test')->group(function () {
            Route::get('/list', 'Practitioner\LabTestController@index')->name('practitionerLabTestList');
            Route::get('/create', 'Practitioner\LabTestController@create')->name('practitionerLabTestCreate');
            Route::post('/store', 'Practitioner\LabTestController@store')->name('practitionerLabTestStore');
            Route::post('/delete', 'Practitioner\LabTestController@delete')->name('practitionerLabTestDelete');
        });
    });

});



// Clinic LOGIN ROUTES
Route::get('/clinic/login', 'Clinic\LoginController@loginForm')->name('clinicLoginForm');
Route::get('/clinic/register', 'Clinic\LoginController@registerForm')->name('clinicRegisterForm');
Route::post('/clinic/register', 'Clinic\LoginController@register')->name('clinicRegister');
Route::post('/clinic/login', 'Clinic\LoginController@login')->name('clinicLogin');

// Clinic password reset routes
Route::get('clinic/password-reset', 'Clinic\LoginController@passwordForgotForm')->name('clinicPasswordForgotForm');
Route::post('clinic/forget-password', 'Clinic\LoginController@passwordForgotEmail')->name('clinicPasswordForgotEmail');
Route::get('/clinic/password/reset/{token}', 'Auth\ClinicResetPasswordController@showResetForm')->name('clinicPasswordReset');
Route::post('/clinic/password/reset/', 'Auth\ClinicResetPasswordController@reset')->name('resetPasswordClinic');


Route::middleware(['clinic'])->group(function () {

    Route::prefix('clinic')->group(function () {

        // CLINIC Notification Route
        Route::prefix('notification')->group(function () {
            Route::get('/detail/{id}', 'Clinic\ClinicController@notificationDetail')->name('clinicNotificationDetail');
        });

        // CLINIC Logout Route
        Route::post('/logout', 'Clinic\LoginController@clinicLogout')->name('clinicLogout');

        // CLINIC Dashboard Route
        Route::get('/dashboard', 'Clinic\ClinicController@index')->name('clinicDashboard');

        // CLINIC Profile Edit Route
        Route::prefix('profile')->group(function () {
            Route::get('/edit', 'Clinic\ClinicController@editProfile')->name('clinicEditProfile');
            Route::post('/update', 'Clinic\ClinicController@updateProfile')->name('clinicUpdateProfile');
        });

        // CLINIC Doctors Route
        Route::prefix('practitioner')->group(function () {
            Route::get('/list', 'Clinic\ClinicController@practitionerList')->name('clinicPractitionerList');
            Route::get('/profile/{id}', 'Clinic\ClinicController@practitionerProfile')->name('practitionerProfile');

        });

        // CLINIC Data Edit Route
        Route::prefix('data')->group(function () {
            Route::get('/edit', 'Clinic\ClinicController@editData')->name('clinicEditData');
            Route::post('/update', 'Clinic\ClinicController@updateData')->name('clinicUpdateData');
        });
    });

});


// ADMIN LOGIN ROUTES
Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::middleware(['admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        // ADMIN Logout Route
        Route::post('/logout', 'Auth\LoginController@userlogout')->name('adminLogout');

        // ADMIN Dashboard Route
        Route::get('/dashboard', 'Admin\AdminController@index')->name('adminDashboard');

        // ADMIN Profile Edit Route
        Route::prefix('profile')->group(function () {
            Route::get('/edit', 'Admin\AdminController@editProfile')->name('adminEditProfile');
            Route::post('/update', 'Admin\AdminController@updateProfile')->name('adminUpdateProfile');
        });

        // User CRUD Route
        Route::group(['prefix' => 'user', 'middleware' => 'permission:manage-users'], function () {
            Route::get('/list', 'Admin\UserController@index')->name('userList');
            Route::get('/create', 'Admin\UserController@create')->name('userCreate');
            Route::post('/store', 'Admin\UserController@store')->name('userStore');
            Route::get('/edit/{id}', 'Admin\UserController@edit')->name('userEdit');
            Route::post('/update', 'Admin\UserController@update')->name('userUpdate');
            Route::post('/delete', 'Admin\UserController@delete')->name('userDelete');
            Route::post('/change-user-status', 'Admin\UserController@changeUserStatus')->name('changeUserStatus');
        });

        // Specialty CRUD Route
        Route::group(['prefix' => 'spetialty', 'middleware' => 'permission:manage-specialties'], function () {
            Route::get('/list', 'Admin\SpecialtyController@index')->name('specialtyList');
            Route::get('/create', 'Admin\SpecialtyController@create')->name('specialtyCreate');
            Route::post('/store', 'Admin\SpecialtyController@store')->name('specialtyStore');
            Route::get('/edit/{id}', 'Admin\SpecialtyController@edit')->name('specialtyEdit');
            Route::post('/update', 'Admin\SpecialtyController@update')->name('specialtyUpdate');
            Route::post('/delete', 'Admin\SpecialtyController@delete')->name('specialtyDelete');
        });

        // Medication CRUD Route
        Route::group(['prefix' => 'medication', 'middleware' => 'permission:manage-medications'], function () {
            Route::get('/list', 'Admin\MedicationController@index')->name('medicationList');
            Route::get('/create', 'Admin\MedicationController@create')->name('medicationCreate');
            Route::post('/store', 'Admin\MedicationController@store')->name('medicationStore');
            Route::get('/edit/{id}', 'Admin\MedicationController@edit')->name('medicationEdit');
            Route::post('/update', 'Admin\MedicationController@update')->name('medicationUpdate');
            Route::post('/delete', 'Admin\MedicationController@delete')->name('medicationDelete');
        });

        // Qualification CRUD Route
        Route::group(['prefix' => 'qualification', 'middleware' => 'permission:manage-qualifications'], function () {
            Route::get('/list', 'Admin\QualificationController@index')->name('qualificationList');
            Route::get('/create', 'Admin\QualificationController@create')->name('qualificationCreate');
            Route::post('/store', 'Admin\QualificationController@store')->name('qualificationStore');
            Route::get('/edit/{id}', 'Admin\QualificationController@edit')->name('qualificationEdit');
            Route::post('/update', 'Admin\QualificationController@update')->name('qualificationUpdate');
            Route::post('/delete', 'Admin\QualificationController@delete')->name('qualificationDelete');
        });

        // Allergy CRUD Route
        Route::group(['prefix' => 'allergy', 'middleware' => 'permission:manage-allergies'], function () {
            Route::get('/list', 'Admin\AllergyController@index')->name('allergyList');
            Route::get('/create', 'Admin\AllergyController@create')->name('allergyCreate');
            Route::post('/store', 'Admin\AllergyController@store')->name('allergyStore');
            Route::get('/edit/{id}', 'Admin\AllergyController@edit')->name('allergyEdit');
            Route::post('/update', 'Admin\AllergyController@update')->name('allergyUpdate');
            Route::post('/delete', 'Admin\AllergyController@delete')->name('allergyDelete');
        });

        // Disease CRUD Route
        Route::group(['prefix' => 'disease', 'middleware' => 'permission:manage-diseases'], function () {
            Route::get('/list', 'Admin\DiseaseController@index')->name('diseaseList');
            Route::get('/create', 'Admin\DiseaseController@create')->name('diseaseCreate');
            Route::post('/store', 'Admin\DiseaseController@store')->name('diseaseStore');
            Route::get('/edit/{id}', 'Admin\DiseaseController@edit')->name('diseaseEdit');
            Route::post('/update', 'Admin\DiseaseController@update')->name('diseaseUpdate');
            Route::post('/delete', 'Admin\DiseaseController@delete')->name('diseaseDelete');
        });

        // Surgery CRUD Route
        Route::group(['prefix' => 'surgery', 'middleware' => 'permission:manage-surgeries'], function () {
            Route::get('/list', 'Admin\SurgeryController@index')->name('surgeryList');
            Route::get('/create', 'Admin\SurgeryController@create')->name('surgeryCreate');
            Route::post('/store', 'Admin\SurgeryController@store')->name('surgeryStore');
            Route::get('/edit/{id}', 'Admin\SurgeryController@edit')->name('surgeryEdit');
            Route::post('/update', 'Admin\SurgeryController@update')->name('surgeryUpdate');
            Route::post('/delete', 'Admin\SurgeryController@delete')->name('surgeryDelete');
        });

        // Drug CRUD Route
        Route::group(['prefix' => 'drug', 'middleware' => 'permission:manage-drugs'], function () {
            Route::get('/list', 'Admin\DrugController@index')->name('drugList');
            Route::get('/create', 'Admin\DrugController@create')->name('drugCreate');
            Route::post('/store', 'Admin\DrugController@store')->name('drugStore');
            Route::get('/edit/{id}', 'Admin\DrugController@edit')->name('drugEdit');
            Route::post('/update', 'Admin\DrugController@update')->name('drugUpdate');
            Route::post('/delete', 'Admin\DrugController@delete')->name('drugDelete');
        });

        // Physical Examination CRUD Route
        Route::group(['prefix' => 'physical-exam', 'middleware' => 'permission:manage-physical-exams'], function () {
            Route::get('/list', 'Admin\PhysicalExamController@index')->name('physicalExamList');
            Route::get('/create', 'Admin\PhysicalExamController@create')->name('physicalExamCreate');
            Route::post('/store', 'Admin\PhysicalExamController@store')->name('physicalExamStore');
            Route::get('/edit/{id}', 'Admin\PhysicalExamController@edit')->name('physicalExamEdit');
            Route::post('/update', 'Admin\PhysicalExamController@update')->name('physicalExamUpdate');
            Route::post('/delete', 'Admin\PhysicalExamController@delete')->name('physicalExamDelete');
        });

        // Patient Type CRUD Route
        Route::group(['prefix' => 'patient-type', 'middleware' => 'permission:manage-patient-types'], function () {
            Route::get('/list', 'Admin\PatientTypeController@index')->name('patientTypeList');
            Route::get('/create', 'Admin\PatientTypeController@create')->name('patientTypeCreate');
            Route::post('/store', 'Admin\PatientTypeController@store')->name('patientTypeStore');
            Route::get('/edit/{id}', 'Admin\PatientTypeController@edit')->name('patientTypeEdit');
            Route::post('/update', 'Admin\PatientTypeController@update')->name('patientTypeUpdate');
            Route::post('/delete', 'Admin\PatientTypeController@delete')->name('patientTypeDelete');
        });

        // Prescription Template CRUD Route
        Route::group(['prefix' => 'prescription-template', 'middleware' => 'permission:manage-prescription-templates'], function () {
            Route::get('/list', 'Admin\PrescriptionTemplateController@index')->name('prescriptionTemplateList');
            Route::get('/create', 'Admin\PrescriptionTemplateController@create')->name('prescriptionTemplateCreate');
            Route::post('/store', 'Admin\PrescriptionTemplateController@store')->name('prescriptionTemplateStore');
            Route::get('/edit/{id}', 'Admin\PrescriptionTemplateController@edit')->name('prescriptionTemplateEdit');
            Route::post('/update', 'Admin\PrescriptionTemplateController@update')->name('prescriptionTemplateUpdate');
            Route::post('/delete', 'Admin\PrescriptionTemplateController@delete')->name('prescriptionTemplateDelete');
        });

        // Medication CRUD Route
        Route::group(['prefix' => 'facility', 'middleware' => 'permission:manage-facilities'], function () {
            Route::get('/list', 'Admin\FacilityController@index')->name('facilityList');
            Route::get('/create', 'Admin\FacilityController@create')->name('facilityCreate');
            Route::post('/store', 'Admin\FacilityController@store')->name('facilityStore');
            Route::get('/edit/{id}', 'Admin\FacilityController@edit')->name('facilityEdit');
            Route::post('/update', 'Admin\FacilityController@update')->name('facilityUpdate');
            Route::post('/delete', 'Admin\FacilityController@delete')->name('facilityDelete');
            Route::post('/changeFacilityStatus', 'Admin\FacilityController@changeFacilityStatus')->name('changeFacilityStatus');
        });

        Route::group(['prefix' => 'lab', 'middleware' => 'permission:manage-labs'], function () {
            Route::get('/list', 'Admin\LabController@index')->name('labList');
            Route::get('/create', 'Admin\LabController@create')->name('labCreate');
            Route::post('/store', 'Admin\LabController@store')->name('labStore');
            Route::get('/edit/{id}', 'Admin\LabController@edit')->name('labEdit');
            Route::post('/update', 'Admin\LabController@update')->name('labUpdate');
            Route::post('/delete', 'Admin\LabController@delete')->name('labDelete');
        });

        Route::group(['prefix' => 'lab-test', 'middleware' => 'permission:manage-lab-tests'], function () {
            Route::get('/list', 'Admin\LabTestController@index')->name('labTestList');
            Route::get('/create', 'Admin\LabTestController@create')->name('labTestCreate');
            Route::post('/store', 'Admin\LabTestController@store')->name('labTestStore');
            Route::get('/edit/{id}', 'Admin\LabTestController@edit')->name('labTestEdit');
            Route::post('/update', 'Admin\LabTestController@update')->name('labTestUpdate');
            Route::post('/delete', 'Admin\LabTestController@delete')->name('labTestDelete');
        });


        Route::group(['prefix' => 'lab-test-type', 'middleware' => 'permission:manage-lab-tests-type'], function () {
            Route::get('/list', 'Admin\LabTestTypeController@index')->name('labTestTypeList');
            Route::get('/create', 'Admin\LabTestTypeController@create')->name('labTestTypeCreate');
            Route::post('/store', 'Admin\LabTestTypeController@store')->name('labTestTypeStore');
            Route::get('/edit/{id}', 'Admin\LabTestTypeController@edit')->name('labTestTypeEdit');
            Route::post('/update', 'Admin\LabTestTypeController@update')->name('labTestTypeUpdate');
            Route::post('/delete', 'Admin\LabTestTypeController@delete')->name('labTestTypeDelete');
        });

        Route::group(['prefix' => 'hospital', 'middleware' => 'permission:manage-hospitals'], function () {
            Route::get('/list', 'Admin\HospitalController@index')->name('hospitalList');
            Route::get('/create', 'Admin\HospitalController@create')->name('hospitalCreate');
            Route::post('/store', 'Admin\HospitalController@store')->name('hospitalStore');
            Route::get('/detail/{id}', 'Admin\HospitalController@detail')->name('hospitalDetail');
            Route::get('/edit/{id}', 'Admin\HospitalController@edit')->name('hospitalEdit');
            Route::post('/update', 'Admin\HospitalController@update')->name('hospitalUpdate');
            Route::post('/delete', 'Admin\HospitalController@delete')->name('hospitalDelete');
            Route::post('/changeHospitalStatus', 'Admin\HospitalController@changeHospitalStatus')->name('changeHospitalStatus');
        });


        Route::group(['prefix' => 'clinic-configuration', 'middleware' => 'permission:manage-clinic-configurations'], function () {
            Route::get('/list', 'Admin\ClinicConfigurationController@index')->name('clinicConfigurationList');
            Route::get('/create', 'Admin\ClinicConfigurationController@create')->name('clinicConfigurationCreate');
            Route::post('/store', 'Admin\ClinicConfigurationController@store')->name('clinicConfigurationStore');
            Route::get('/detail/{id}', 'Admin\ClinicConfigurationController@detail')->name('clinicConfigurationDetail');
            Route::get('/edit/{id}', 'Admin\ClinicConfigurationController@edit')->name('clinicConfigurationEdit');
            Route::post('/update', 'Admin\ClinicConfigurationController@update')->name('clinicConfigurationUpdate');
            Route::post('/delete', 'Admin\ClinicConfigurationController@delete')->name('clinicConfigurationDelete');
        });

        Route::group(['prefix' => 'department', 'middleware' => 'permission:manage-departments'], function () {
            Route::get('/list', 'Admin\DepartmentController@index')->name('departmentList');
            Route::get('/create', 'Admin\DepartmentController@create')->name('departmentCreate');
            Route::post('/store', 'Admin\DepartmentController@store')->name('departmentStore');
            Route::get('/edit/{id}', 'Admin\DepartmentController@edit')->name('departmentEdit');
            Route::post('/update', 'Admin\DepartmentController@update')->name('departmentUpdate');
            Route::post('/delete', 'Admin\DepartmentController@delete')->name('departmentDelete');
        });

        // Clinic CRUD Route
        Route::group(['prefix' => 'clinic', 'middleware' => 'permission:manage-clinics'], function () {
            Route::get('/list', 'Admin\ClinicController@index')->name('clinicList');
            Route::get('/create', 'Admin\ClinicController@create')->name('clinicCreate');
            Route::post('/store', 'Admin\ClinicController@store')->name('clinicStore');
            Route::get('/edit/{id}', 'Admin\ClinicController@edit')->name('clinicEdit');
            Route::post('/update', 'Admin\ClinicController@update')->name('clinicUpdate');
        });

        // Relation CRUD Route
        Route::group(['prefix' => 'relation', 'middleware' => 'permission:manage-relations'], function () {
            Route::get('/list', 'Admin\RelationController@index')->name('relationList');
            Route::get('/create', 'Admin\RelationController@create')->name('relationCreate');
            Route::post('/store', 'Admin\RelationController@store')->name('relationStore');
            Route::get('/edit/{id}', 'Admin\RelationController@edit')->name('relationEdit');
            Route::post('/update', 'Admin\RelationController@update')->name('relationUpdate');
            Route::post('/delete', 'Admin\RelationController@delete')->name('relationDelete');
        });

        // Reaction CRUD Route
        Route::group(['prefix' => 'reaction', 'middleware' => 'permission:manage-reactions'], function () {
            Route::get('/list', 'Admin\ReactionController@index')->name('reactionList');
            Route::get('/create', 'Admin\ReactionController@create')->name('reactionCreate');
            Route::post('/store', 'Admin\ReactionController@store')->name('reactionStore');
            Route::get('/edit/{id}', 'Admin\ReactionController@edit')->name('reactionEdit');
            Route::post('/update', 'Admin\ReactionController@update')->name('reactionUpdate');
            Route::post('/delete', 'Admin\ReactionController@delete')->name('reactionDelete');
        });

        // Unit CRUD Route
        Route::group(['prefix' => 'unit', 'middleware' => 'permission:manage-units'], function () {
            Route::get('/list', 'Admin\UnitController@index')->name('unitList');
            Route::get('/create', 'Admin\UnitController@create')->name('unitCreate');
            Route::post('/store', 'Admin\UnitController@store')->name('unitStore');
            Route::get('/edit/{id}', 'Admin\UnitController@edit')->name('unitEdit');
            Route::post('/update', 'Admin\UnitController@update')->name('unitUpdate');
            Route::post('/delete', 'Admin\UnitController@delete')->name('unitDelete');
        });

        // Dose CRUD Route
        Route::group(['prefix' => 'dose', 'middleware' => 'permission:manage-doses'], function () {
            Route::get('/list', 'Admin\DoseController@index')->name('doseList');
            Route::get('/create', 'Admin\DoseController@create')->name('doseCreate');
            Route::post('/store', 'Admin\DoseController@store')->name('doseStore');
            Route::get('/edit/{id}', 'Admin\DoseController@edit')->name('doseEdit');
            Route::post('/update', 'Admin\DoseController@update')->name('doseUpdate');
            Route::post('/delete', 'Admin\DoseController@delete')->name('doseDelete');
        });

        // Frequency CRUD Route
        Route::group(['prefix' => 'frequency', 'middleware' => 'permission:manage-frequencies'], function () {
            Route::get('/list', 'Admin\FrequencyController@index')->name('frequencyList');
            Route::get('/create', 'Admin\FrequencyController@create')->name('frequencyCreate');
            Route::post('/store', 'Admin\FrequencyController@store')->name('frequencyStore');
            Route::get('/edit/{id}', 'Admin\FrequencyController@edit')->name('frequencyEdit');
            Route::post('/update', 'Admin\FrequencyController@update')->name('frequencyUpdate');
            Route::post('/delete', 'Admin\FrequencyController@delete')->name('frequencyDelete');
        });

        // Duration CRUD Route
        Route::group(['prefix' => 'duration', 'middleware' => 'permission:manage-durations'], function () {
            Route::get('/list', 'Admin\DurationController@index')->name('durationList');
            Route::get('/create', 'Admin\DurationController@create')->name('durationCreate');
            Route::post('/store', 'Admin\DurationController@store')->name('durationStore');
            Route::get('/edit/{id}', 'Admin\DurationController@edit')->name('durationEdit');
            Route::post('/update', 'Admin\DurationController@update')->name('durationUpdate');
            Route::post('/delete', 'Admin\DurationController@delete')->name('durationDelete');
        });

        // Diagnosis Type CRUD Route
        Route::group(['prefix' => 'diagnosis-type', 'middleware' => 'permission:manage-diagnosis-types'], function () {
            Route::get('/list', 'Admin\DiagnosisTypeController@index')->name('diagnosisTypeList');
            Route::get('/create', 'Admin\DiagnosisTypeController@create')->name('diagnosisTypeCreate');
            Route::post('/store', 'Admin\DiagnosisTypeController@store')->name('diagnosisTypeStore');
            Route::get('/edit/{id}', 'Admin\DiagnosisTypeController@edit')->name('diagnosisTypeEdit');
            Route::post('/update', 'Admin\DiagnosisTypeController@update')->name('diagnosisTypeUpdate');
            Route::post('/delete', 'Admin\DiagnosisTypeController@delete')->name('diagnosisTypeDelete');
        });

        // Practitioner CRUD Route
        Route::group(['prefix' => 'practitioner', 'middleware' => 'permission:manage-practitioners'], function () {
            Route::get('/list', 'Admin\PractitionerController@index')->name('practitionerList');
            Route::get('/create', 'Admin\PractitionerController@create')->name('practitionerCreate');
            Route::get('/detail/{id}', 'Admin\PatientController@detail')->name('patientDetail');
            Route::post('/store', 'Admin\PractitionerController@store')->name('practitionerStore');
            Route::get('/edit/{id}', 'Admin\PractitionerController@edit')->name('practitionerEdit');
            Route::post('/update', 'Admin\PractitionerController@update')->name('practitionerUpdate');
            Route::post('/change-practitioner-status', 'Admin\PractitionerController@changePractitionerStatus')->name('changePractitionerStatus');
            Route::get('/detail/{id}', 'Admin\PractitionerController@detail')->name('practitionerDetail');

            Route::get('/appointments/{id}', 'Admin\PractitionerController@practitionerAppointments')->name('practitionerAppointments');
            Route::get('/patients/{id}', 'Admin\PractitionerController@practitionerPatients')->name('practitionerPatients');
            Route::get('/assistants/{id}', 'Admin\PractitionerController@practitionerAssistants')->name('practitionerAssistants');
        });

        // Assistant CRUD Route
        Route::group(['prefix' => 'assistant', 'middleware' => 'permission:manage-assistants'], function () {
            Route::get('/list', 'Admin\AssistantController@index')->name('assistantList');
            Route::get('/create', 'Admin\AssistantController@create')->name('assistantCreate');
            Route::post('/store', 'Admin\AssistantController@store')->name('assistantStore');
            Route::get('/edit/{id}', 'Admin\AssistantController@edit')->name('assistantEdit');
            Route::post('/update', 'Admin\AssistantController@update')->name('assistantUpdate');
            Route::post('/change-assistant-status', 'Admin\AssistantController@changeAssistantStatus')->name('changeAssistantStatus');
            Route::get('/detail/{id}', 'Admin\AssistantController@detail')->name('assistantDetail');

            Route::get('/appointments/{id}', 'Admin\AssistantController@assistantAppointments')->name('assistantAppointments');
            Route::get('/patients/{id}', 'Admin\AssistantController@assistantPatients')->name('assistantPatients');
        });

        // Patient CRUD Route
        Route::group(['prefix' => 'patient', 'middleware' => 'permission:manage-patients'], function () {
            Route::get('/list', 'Admin\PatientController@index')->name('patientList');
            Route::get('/create', 'Admin\PatientController@create')->name('patientCreate');
            Route::post('/store', 'Admin\PatientController@store')->name('patientStore');
            Route::get('/edit/{id}', 'Admin\PatientController@edit')->name('patientEdit');
            Route::post('/update', 'Admin\PatientController@update')->name('patientUpdate');
            Route::get('/detail/{id}', 'Admin\PatientController@detail')->name('patientDetail');
            Route::post('/delete-report', 'Admin\PatientController@deleteReport')->name('patientReportDelete');
            Route::get('/previous-visits/{id}', 'Admin\PatientController@patientPreviousVisits')->name('patientPreviousVisits');
            Route::get('/previous-visits-detail/{id}', 'Admin\PatientController@patientPreviousVisitDetail')->name('patientPreviousVisitDetail');

            // Prescription CRUD Route
            Route::prefix('prescription')->group(function () {
                Route::get('/list/{id}', 'Admin\PrescriptionController@index')->name('prescriptionList');
                Route::get('/create/{id}', 'Admin\PrescriptionController@create')->name('prescriptionCreate');
                Route::post('/store', 'Admin\PrescriptionController@store')->name('prescriptionStore');
                Route::get('/edit/{id}', 'Admin\PrescriptionController@edit')->name('prescriptionEdit');
                Route::post('/update', 'Admin\PrescriptionController@update')->name('prescriptionUpdate');
                Route::post('/getClinics', 'Admin\PrescriptionController@getClinics')->name('prescriptionGetClinics');

            });

        });

        // Appointment CRUD Route
        Route::group(['prefix' => 'appointment', 'middleware' => 'permission:manage-appointments'], function () {
            Route::get('/list', 'Admin\AppointmentController@index')->name('appointmentList');
            Route::get('/create', 'Admin\AppointmentController@create')->name('appointmentCreate');
            Route::post('/store', 'Admin\AppointmentController@store')->name('appointmentStore');
            Route::get('/edit/{id}', 'Admin\AppointmentController@edit')->name('appointmentEdit');
            Route::post('/update', 'Admin\AppointmentController@update')->name('appointmentUpdate');
            Route::post('/getClinics', 'Admin\AppointmentController@getClinics')->name('getClinics');
            Route::post('/getTimeSlots', 'Admin\AppointmentController@getTimeSlots')->name('getTimeSlots');
            Route::post('/filter', 'Admin\AppointmentController@appointmentFilter')->name('appointmentFilter');
        });

        // Payment CRUD Route
        Route::group(['prefix' => 'payment', 'middleware' => 'permission:manage-payments'], function () {
            Route::get('/list', 'Admin\PaymentController@index')->name('paymentList');
            Route::get('/edit/{id}', 'Admin\PaymentController@edit')->name('paymentEdit');
            Route::post('/update/{id}', 'Admin\PaymentController@update')->name('updatePayment');
        });

        // Notifications  Route
        Route::group(['prefix' => 'notification', 'middleware' => 'permission:manage-notifications'], function () {
            Route::get('/detail/{id}', 'Admin\AdminController@notificationDetail')->name('notificationDetail');

        });


    });

});



Route::get('/clear-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
     return 'Cache Clear';
});
