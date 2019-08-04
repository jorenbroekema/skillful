<?php

namespace App\Http\Controllers;

use App\BugReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BugController extends Controller
{
    /**
     * Add a bug report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBug(Request $request)
    {
        $attributes = $request->validate([
            'name' => [],
            'url' => ['required'],
            'description' => ['required', 'min:10'],
        ]);

        $bug = BugReport::create($attributes);
        if (auth()->user()) {
            $bug->author()->associate(auth()->user());
        }
        $bug->save();

        // TODO: Send an email to us so we get the feedback immediately
        return back()->with('success', 'Thanks for sending your bug report, we will look at it as soon as possible!');
    }
}
