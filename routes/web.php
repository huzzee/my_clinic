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
    Route::post('adminsactivate/{id}','AdminController@activated')->name('adminsactivate.activate');
    Route::Resource('clinics','ClinicController');
    Route::Resource('doctors','DoctorController');
    Route::post('doctoractive/{id}','DoctorController@activated')->name('doctoractive.activate');
    Route::Resource('employee','EmployeeController');
    Route::post('employeeactivate/{id}','EmployeeController@activated')->name('employeeactivate.activate');
    Route::Resource('patients','PatientController');
    Route::Resource('services','ClinicServiceController');
    Route::Resource('service_categories','ServiceCategoryController');
    Route::Resource('drugs','MedicineController');
    Route::post('updateStock/{id}','MedicineController@updateStock');
    Route::Resource('schedule','ScheduleController');
    Route::get('doc_schedule_chk','ScheduleController@schedule_chk');
    Route::post('schedule_inactive/{id}','ScheduleController@schedule_inactive')->name('schedule_inactive.deactivate');
    Route::post('schedule_active/{id}','ScheduleController@schedule_active')->name('schedule_active.activate');

    Route::Resource('leaves','LeaveController');
    Route::get('leaves_approved','LeaveController@approved')->name('leaves_approved.leaves_approved');
    Route::post('leaves_approved/{id}','LeaveController@approval');
    Route::post('leaves_rejected/{id}','LeaveController@reject');

    Route::get('drugCategory','MedicineController@drugCategory')->name('drugCategory.category');
    Route::post('drugCategory','MedicineController@drugCategoryStore')->name('drugCategory.drugCategoryStore');
    Route::delete('drugCategory/{id}','MedicineController@drugCategoryDestroy')->name('drugCategory.drugCategoryDestroy');

    Route::get('drugStock','MedicineController@drugStock')->name('drugStock.category');
    Route::post('drugStock','MedicineController@drugStockStore')->name('drugStock.drugStockStore');
    Route::delete('drugStock/{id}','MedicineController@drugStockDestroy')->name('drugStock.drugStockDestroy');

    Route::Resource('medical_records','MedicalRecordController');
    Route::get('deleted_medical_records','MedicalRecordController@deleted_record')->name('deleted_medical_records.deleted_record');
    Route::get('temp_change','MedicalRecordController@temp_change');
    Route::Resource('drawing_templates','DrawingTemplateController');
    Route::Resource('diagnoses','DiagnoseController');
    Route::Resource('medical_templates','MedicalTemplateController');
    Route::get('record_ajax','MedicalRecordController@template');

    Route::Resource('queues','QueueController');
    Route::post('queues_doc','QueueController@queue_doc');
    Route::post('queues_note','QueueController@queue_note');
    Route::get('settled_queues','QueueController@settled_queues')->name('settled_queues.settled_queues');
    Route::get('deleted_queues','QueueController@deleted_queues')->name('deleted_queues.deleted_queues');

    Route::Resource('invoices','InvoiceController');
    Route::post('invoice_add','InvoiceController@add_invoice');
    Route::get('invoice_add/{patient}/{doctor}','InvoiceController@create_invoice')->name('invoice_add.create_invoice');

    Route::Resource('payments','PaymentController');
    Route::get('payments_print/{id}','PaymentController@payments_print')->name('payments_print.payments_print');
    Route::get('/drugs_press','InvoiceController@drug_press');
    Route::get('/services_press','InvoiceController@service_press');
    Route::get('/services_price','InvoiceController@service_price');

    Route::Resource('prescriptions','PrescriptionController');

    Route::get('permissions_klenic_abc','PermissionController@index')->name('permissions_klenic_abc.index');
    Route::get('role_chk','PermissionController@role_chk');
    Route::get('ajaxupdatepermissions','PermissionController@updatePermissions');

});