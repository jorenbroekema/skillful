<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMembersController extends Controller
{
    // TODO: Change to DRY -> a single addOrRemove function
    public function addMember(Request $request)
    {
        $group = Group::find($request->group);
        $member = Auth::user();

        if (!$group->members()->get()->contains($member)) {
            $group->members()->save($member);
        }

        $lastCharOriginURL = substr($request->header('referer'), -1);
        $originatesFromShow = is_numeric($lastCharOriginURL);

        return redirect('/groups/' . ($originatesFromShow ? $lastCharOriginURL : ''));
    }

    public function removeMember(Request $request)
    {
        $group = Group::find($request->group);
        $member = Auth::user();

        if ($group->members()->get()->contains($member)) {
            $group->members()->detach($member);
        }

        $lastCharOriginURL = substr($request->header('referer'), -1);
        $originatesFromShow = is_numeric($lastCharOriginURL);

        return redirect('/groups/' . ($originatesFromShow ? $lastCharOriginURL : ''));
    }
}
