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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('', 'HomeController@index');

Route::get('/bug', function () {
    return view('bug');
});
Route::post('bug', 'BugController@addBug');

Route::get('/feedback', function () {
    return view('feedback');
});
Route::post('feedback', 'FeedbackController@addFeedback');


/**
 * Workshop related controllers
 */
Route::resource('workshops', 'WorkshopsController');
Route::patch('participants/{participant}', 'WorkshopParticipantsController@addParticipant');
Route::delete('participants/{participant}', 'WorkshopParticipantsController@removeParticipant');

/**
 * Group related controllers
 */
Route::resource('groups', 'GroupsController');
Route::patch('members/{member}', 'GroupMembersController@addMember');
Route::delete('members/{member}', 'GroupMembersController@removeMember');
