<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMembersController extends Controller
{
    public function addOrRemoveMember(Group $group, bool $add = true)
    {
        $member = Auth::user();
        $memberIsInGroup = $group->members()->get()->contains($member);

        if ($add) {
            if (!$memberIsInGroup) {
                $group->members()->save($member);
            }
        } else {
            if ($memberIsInGroup) {
                $group->members()->detach($member);
            }
        }
    }

    public function addMember(Request $request)
    {
        $group = Group::find($request->group);
        $this->addOrRemoveMember($group);
        return back()->with('success', 'You are now a member of '.$group->name.'!');
    }

    public function removeMember(Request $request)
    {
        $group = Group::find($request->group);
        $this->addOrRemoveMember($group, false);
        return back()->with('warning', 'You are no longer a member of '.$group->name.'.');
    }
}
