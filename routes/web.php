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
    return view('pages.interview_management');
});


/* login */
Route::get('/login', 'UserController@getLogin');

Route::post('/login', 'UserController@postLogin');

/* logout */
Route::get('/logout', 'UserController@logout');

/* change Password */
Route::get('/changepassword/{username}/{password}', 'UserController@getChangePassword');

Route::post('/changepassword/{username}/{password}', 'UserController@changePassword');



/*************sba interview ********************/

/* staff */
Route::get('/interview-management', 'InterviewManagementController@index');

Route::get('/interview-management/new', 'InterviewManagementController@getInterviewerNew');

Route::post('interview-management/new', 'InterviewManagementController@postInterviewerNew');

Route::get('/interview-management/edit/{id}', 'InterviewManagementController@getInterviewerEdit');

Route::post('/interview-management/edit/{id}', 'InterviewManagementController@postInterviewerEdit');

Route::get('/interview-management/delete/{id}', 'InterviewManagementController@getInterviewerDelete');