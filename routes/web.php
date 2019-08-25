<?php

use Illuminate\Http\Request;

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
Route::get('', 'HomeController@index');

/**
 * Auth related
 */
Auth::routes();
Route::post('/changePassword', 'Auth\ChangePasswordController@changePassword');
Route::post('/changeEmail', function(Request $request) {
    $request->validate([
        'email' => 'required|string|email|max:225|unique:users',
    ]);

    $newEmail = $request->get('email');
    if ($newEmail === Auth::user()->email) {
        return back()->withErrors([
            "error" => "This is already your email address. Please choose a different email address."
        ]);
    }
    $user = Auth::user();
    $user->email = $newEmail;
    $user->save();
    return back()->with("success", "Password changed successfully!");
});

/**
 * Bug reports
 */
Route::get('/bug', function () {
    return view('bug');
});
Route::post('bug', 'BugController@addBug');

/**
 * Feedback
 */
Route::get('/feedback', function () {
    return view('feedback');
});
Route::post('feedback', 'FeedbackController@addFeedback');

/**
 * Dashboard
 */
Route::get('/dashboard', function () {
    return view('user-profile.dashboard', Auth::user());
})->middleware('auth');

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
