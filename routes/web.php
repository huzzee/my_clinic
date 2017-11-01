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

    Route::Resource('/admins','AdminController');
    Route::post('adminsactivate/{id}','AdminController@activated');
    Route::Resource('clinics','ClinicController');
    Route::Resource('doctors','DoctorController');
    Route::post('doctoractive/{id}','DoctorController@activated');
    Route::Resource('employee','EmployeeController');
    Route::post('employeeactivate/{id}','EmployeeController@activated');
});