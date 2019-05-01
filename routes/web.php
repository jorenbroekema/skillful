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
