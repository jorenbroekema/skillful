<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Change Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password changes.
    |
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return back()->withErrors([
                "error" => "Your current password does not match the password you provided. Please try again."
            ]);
        }

        if ($request->get('current_password') === $request->get('new_password')) {
            return back()->withErrors([
                "error" => "New password cannot be same as your current password. Please choose a different password."
            ]);
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->with("success", "Password changed successfully!");
    }
}
