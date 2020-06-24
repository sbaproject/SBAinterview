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



/*************sba interview ********************/

/* interview-management */
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
    Route::get('/{id}','UserHomeController@userHomeEditById')->name('userHomeEditById');
    Route::post('/update','UserHomeController@postUserHomeEditById')->name('postUserHomeEditById');
    Route::get('/test/{type}','UserHomeController@postUserTest')->name('postUserTest');
    Route::post('/test/tech','UserHomeController@postResultTech')->name('postResultTech');
    Route::post('/test/iq','UserHomeController@postResultIQ')->name('postResultIQ');
});

/* tech question */
Route::get('/tech-list', 'TechQuestionController@index');

Route::get('/tech-list/new', 'TechQuestionController@getTechQuestionNew');

Route::post('/tech-list/new', 'TechQuestionController@postTechQuestionNew');

Route::get('/tech-list/edit/{id}', 'TechQuestionController@getTechQuestionEdit');

Route::post('/tech-list/edit/{id}', 'TechQuestionController@postTechQuestionEdit');

Route::get('/tech-list/delete/{id}', 'TechQuestionController@getTechQuestionDelete');

/* iq question */
Route::get('/iq-list', 'IqQuestionController@index');

Route::get('/iq-list/new', 'IqQuestionController@getIqQuestionNew');

Route::post('/iq-list/new', 'IqQuestionController@postIqQuestionNew');

Route::get('/iq-list/edit/{id}', 'IqQuestionController@getIqQuestionEdit');

Route::post('/iq-list/edit/{id}', 'IqQuestionController@postIqQuestionEdit');

Route::get('/iq-list/delete/{id}', 'IqQuestionController@getIqQuestionDelete');

/* iq question */
Route::get('/iq-option-list/{iq_id}', 'IqQuestionOptionController@index');

Route::get('/iq-option/new/{iq_id}', 'IqQuestionOptionController@getIqQuestionOptionNew');

Route::post('/iq-option/new/{iq_id}', 'IqQuestionOptionController@postIqQuestionOptionNew');

Route::get('/iq-option/edit/{op_id}', 'IqQuestionOptionController@getIqQuestionOptionEdit');

Route::post('/iq-option/edit/{op_id}', 'IqQuestionOptionController@postIqQuestionOptionEdit');

Route::get('/iq-option/delete/{op_id}', 'IqQuestionOptionController@getIqQuestionOptionDelete');

/* result */
Route::get('/result-list', 'ResultController@index');

Route::get('/result-iq/{candidate_id}', 'TestAnswerController@resultIQ');
Route::get('/result-tech/{candidate_id}', 'TestAnswerController@ResultTech');
Route::get('/result-tech/mark/{candidate_id}', 'TestAnswerController@getResultTechMark');
Route::post('/result-tech/mark/{candidate_id}', 'TestAnswerController@postResultTechMark');
