<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopParticipantsController extends Controller
{
    // TODO: Change to DRY -> a single addOrRemove function
    public function addParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $participant = Auth::user();
        $workshop->users()->save($participant);

        $lastCharOriginURL = substr($request->header('referer'), -1);
        $originatesFromShow = is_numeric($lastCharOriginURL);

        return redirect('/workshops/' . ($originatesFromShow ? $lastCharOriginURL : ''));
    }

    public function removeParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $participant = Auth::user();
        $workshop->users()->detach($participant);

        $lastCharOriginURL = substr($request->header('referer'), -1);
        $originatesFromShow = is_numeric($lastCharOriginURL);

        return redirect('/workshops/' . ($originatesFromShow ? $lastCharOriginURL : ''));
    }
}
