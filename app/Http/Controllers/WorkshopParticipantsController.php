<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopParticipantsController extends Controller
{
    public function addParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $participant = Auth::user();
        $workshop->users()->save($participant);
        return redirect('/workshops/');
    }

    public function removeParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $participant = Auth::user();
        $workshop->users()->detach($participant);
        return redirect('/workshops/');
    }
}
