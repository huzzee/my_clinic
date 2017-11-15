<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['auth','entity_check','user_status']],function() {

    Route::get('/', 'HomeController@index')->name('home');
    /*Route::get('/',function (){

        \Nexmo\Laravel\Facade\Nexmo::message()->send([
            'to'   => '+6596859324',
            'from' => 'huzaifa',
            'text' => 'hello huzaifa here kerian.'
        ]);
    });*/

    Route::Resource('/admins','AdminController');
    Route::post('adminsactivate/{id}','AdminController@activated');
    Route::Resource('clinics','ClinicController');
    Route::Resource('doctors','DoctorController');
    Route::post('doctoractive/{id}','DoctorController@activated');
    Route::Resource('employee','EmployeeController');
    Route::post('employeeactivate/{id}','EmployeeController@activated');
    Route::Resource('patients','PatientController');
    Route::Resource('services','ClinicServiceController');
    Route::Resource('drugs','MedicineController');
    Route::post('updateStock/{id}','MedicineController@updateStock');
    Route::Resource('schedule','ScheduleController');
    Route::get('doc_schedule_chk','ScheduleController@schedule_chk');
    Route::post('schedule_inactive/{id}','ScheduleController@schedule_inactive');
    Route::post('schedule_active/{id}','ScheduleController@schedule_active');

    Route::Resource('leaves','LeaveController');
    Route::get('leaves_approved','LeaveController@approved')->name('leaves_approved');
    Route::post('leaves_approved/{id}','LeaveController@approval');
    Route::post('leaves_rejected/{id}','LeaveController@reject');

    Route::get('drugCategory','MedicineController@drugCategory')->name('category');
    Route::post('drugCategory','MedicineController@drugCategoryStore')->name('drugCategoryStore');
    Route::delete('drugCategory/{id}','MedicineController@drugCategoryDestroy')->name('drugCategoryDestroy');

    Route::get('drugStock','MedicineController@drugStock')->name('category');
    Route::post('drugStock','MedicineController@drugStockStore')->name('drugStockStore');
    Route::delete('drugStock/{id}','MedicineController@drugStockDestroy')->name('drugStockDestroy');

    Route::Resource('medical_records','MedicalRecordController');
    Route::get('deleted_medical_records','MedicalRecordController@deleted_record')->name('deleted_record');
    Route::get('temp_change','MedicalRecordController@temp_change');
    Route::Resource('drawing_templates','DrawingTemplateController');
    Route::Resource('diagnoses','DiagnoseController');
    Route::Resource('medical_templates','MedicalTemplateController');
    Route::get('record_ajax','MedicalRecordController@template');
});