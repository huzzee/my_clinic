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
    Route::get('get_states','PatientController@get_state');
    Route::get('get_cities','PatientController@get_cities');
    Route::get('get_patient_info','PatientController@get_patient_info');



    Route::Resource('services','ClinicServiceController');
    Route::Resource('service_categories','ServiceCategoryController');
    Route::Resource('drugs','MedicineController');
    Route::get('get_datatable_drug','MedicineController@datatable')->name('get_datatable_drug.data');

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
    Route::post('medical_edit','MedicalRecordController@medical_edit');
    Route::get('medical_records/{pat_id}/{doc_id}','MedicalRecordController@edit_2')->name('medical_records.edit_2');


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
    Route::post('add_to_check','QueueController@add_to_check');

    Route::Resource('invoices','InvoiceController');
    Route::post('invoice_add','InvoiceController@add_invoice');
    Route::get('invoice_add/{patient}/{doctor}','InvoiceController@create_invoice')->name('invoice_add.create_invoice');
    Route::get('get_datatable_invoice','InvoiceController@datatable')->name('get_datatable_invoice.data');

    Route::Resource('payments','PaymentController');
    Route::get('payments_print/{id}','PaymentController@payments_print')->name('payments_print.payments_print');
    Route::get('get_datatable_payment','PaymentController@datatable')->name('get_datatable_payment.data');

    Route::get('/drugs_press','InvoiceController@drug_press');
    Route::get('/services_press','InvoiceController@service_press');
    Route::get('/services_price','InvoiceController@service_price');

    Route::Resource('prescriptions','PrescriptionController');
    Route::get('drugs_autocomplete','PrescriptionController@drugs_autocomplete');
    Route::get('drug_qnt_check','PrescriptionController@drug_qnt_check');
    Route::get('drug_type_check','PrescriptionController@drug_type_check');

    Route::get('permissions_klenic_abc','PermissionController@index')->name('permissions_klenic_abc.index');
    Route::get('role_chk','PermissionController@role_chk');
    Route::get('ajaxupdatepermissions','PermissionController@updatePermissions');

    Route::Resource('appointments','AppointmentController');
    Route::post('appointments_add','AppointmentController@add_app');
    Route::get('appointments_cancel','AppointmentController@canceled')->name('appointments_cancel.canceled');
    Route::get('appointments_today','AppointmentController@today_app')->name('appointments_today.today_app');
    Route::get('appointments_complete','AppointmentController@complete_app')->name('appointments_complete.complete_app');
    Route::post('appointments_cancel/{id}','AppointmentController@cancelation');


    Route::get('get_schedule','AppointmentController@get_schedule');
    Route::get('get_token_chek','AppointmentController@get_token_chek');
    Route::get('get_token_time_chek','AppointmentController@get_token_time_chek');
    Route::get('get_datatable_app','AppointmentController@datatable')->name('get_datatable_app.data');
});