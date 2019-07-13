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
            'url' => ['required'],
            'description' => ['required', 'min:10'],
        ]);

        $bug = BugReport::create($attributes);
        if (auth()->user()) {
            $bug->author()->associate(auth()->user());
        }
        $bug->save();

        return redirect('/bug');
    }
}
