<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkshopParticipantsController extends Controller
{
    private function addOrRemoveParticipant(Request $request, bool $add = true)
    {
        $workshop = Workshop::find($request->workshop);

        $participant = auth()->user();

        $modelAction = $add ? 'save' : 'detach';
        if (Gate::allows('participating', $workshop)) {
            $workshop->users()->$modelAction($participant);
        } else {
            abort(403);
        }


        $lastCharOriginURL = substr($request->header('referer'), -1);
        $originatesFromShow = is_numeric($lastCharOriginURL);

        return redirect('/workshops/' . ($originatesFromShow ? $lastCharOriginURL : ''));
    }

    public function addParticipant(Request $request)
    {
        return $this->addOrRemoveParticipant($request);
    }

    public function removeParticipant(Request $request)
    {
        return $this->addOrRemoveParticipant($request, false);
    }
}
