<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkshopParticipantsController extends Controller
{
    private function addOrRemoveParticipant(Workshop $workshop, bool $add = true)
    {
        $participant = auth()->user();

        $modelAction = $add ? 'save' : 'detach';
        if (Gate::allows('participating', $workshop)) {
            $workshop->users()->$modelAction($participant);
        } else {
            abort(403);
        }
    }

    public function addParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $this->addOrRemoveParticipant($workshop);
        return back()->with('success', 'You are now participating in '.$workshop->title.'!');
    }

    public function removeParticipant(Request $request)
    {
        $workshop = Workshop::find($request->workshop);
        $this->addOrRemoveParticipant($workshop, false);
        return back()->with('warning', 'You are no longer participating in '.$workshop->title.'.');
    }
}
