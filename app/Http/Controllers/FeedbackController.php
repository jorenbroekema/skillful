<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Add a feedback entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFeedback(Request $request)
    {
        $attributes = $request->validate([
            'feedback' => ['required', 'min:10'],
            'name' => [],
        ]);

        $feedback = Feedback::create($attributes);
        if (auth()->user()) {
            $feedback->author()->associate(auth()->user());
        }
        $feedback->save();

        return redirect('/feedback');
    }
}
