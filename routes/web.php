<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('pages.login');
});


/* login */
Route::get('/login', 'UserController@getLogin');

Route::post('/login', 'UserController@postLogin');

/* logout */
Route::get('/logout', 'UserController@logout');

/* change Password */
Route::get('/changepassword/{username}/{password}', 'UserController@getChangePassword');

Route::post('/changepassword/{username}/{password}', 'UserController@changePassword');


/* sales */
Route::get('/sales', 'SalesController@index');

Route::get('/sales/new', 'SalesController@getSalesNew');

Route::post('/sales/new', 'SalesController@postSalesNew');

Route::get('/sales/edit/{id}', 'SalesController@getSalesEdit');

Route::post('/sales/edit/{id}', 'SalesController@postSalesEdit');

Route::get('/sales/delete/{id}', 'SalesController@getSalesDelete');

Route::post('/sales/searchCustomerAjax', 'SalesController@searchCustomerAjax')->name('searchCustomerAjax');

Route::get('/sales/exportExcel','SalesController@exportExcel');
Route::get('/sales/exportCSV','SalesController@exportCSV');


/* staff */
Route::get('/staff', 'StaffController@index');

Route::get('/staff/new', 'StaffController@getStaffNew');

Route::post('/staff/new', 'StaffController@postStaffNew');

Route::get('/staff/edit/{id}', 'StaffController@getStaffEdit');

Route::post('/staff/edit/{id}', 'StaffController@postStaffEdit');

Route::get('/staff/delete/{id}', 'StaffController@getStaffDelete');


/* course */
Route::get('/course', 'CourseController@index');

Route::get('/course/new', 'CourseController@getCourseNew');

Route::post('/course/new', 'CourseController@postCourseNew');

Route::get('/course/edit/{id}', 'CourseController@getCourseEdit');

Route::post('/course/edit/{id}', 'CourseController@postCourseEdit');

Route::get('/course/delete/{id}', 'CourseController@getCourseDelete');


/* option */
Route::get('/option/new', 'OptionController@getOptionNew');

Route::post('/option/new', 'OptionController@postOptionNew');

Route::get('/option/edit/{id}', 'OptionController@getOptionEdit');

Route::post('/option/edit/{id}', 'OptionController@postOptionEdit');

Route::get('/option/delete/{id}', 'OptionController@getOptionDelete');


/* customer */
Route::get('/customer', 'CustomerController@index');

Route::get('/customer/new', 'CustomerController@getCustomerNew');

Route::post('/customer/new', 'CustomerController@postCustomerNew');

Route::get('/customer/edit/{id}', 'CustomerController@getCustomerEdit');

Route::post('/customer/edit/{id}', 'CustomerController@postCustomerEdit');

Route::post('/customer', 'CustomerController@postSearch');



/*************sba interview ********************/

/* staff */
Route::get('/interview-management', 'InterviewManagementController@index');

Route::get('/interview-management/new', 'InterviewManagementController@getInterviewerNew');

Route::post('interview-management/new', 'InterviewManagementController@postInterviewerNew');

Route::get('/interview-management/edit/{id}', 'InterviewManagementController@getInterviewerEdit');

Route::post('/interview-management/edit/{id}', 'InterviewManagementController@postInterviewerEdit');

Route::get('/interview-management/delete/{id}', 'InterviewManagementController@getInterviewerDelete');


/**
 * 
 * frontEnd user 
 * PCVSTARBOARD
 * 
 * **/
Route::group(['prefix' => 'ung-vien'], function () {
    Route::get('/', 'UserHomeController@index')->name('userHome');
    Route::post('/', 'UserHomeController@postUserHome')->name('postUserHome');
    Route::post('/test','UserHomeController@postUserTest')->name('postUserTest');
});