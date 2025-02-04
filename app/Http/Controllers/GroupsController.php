<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = [
            'allGroups' => Group::all(),
            'ownGroups' => Auth::check() ? Auth::user()->groups()->get() : [],
            'ownedGroups' => Auth::check() ? Auth::user()->ownedGroups()->get() : [],
        ];
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);

        $group = new Group($attributes);
        $group->save();
        $group->owner()->associate(auth()->user());
        $group->members()->attach(auth()->user());
        $group->save();

        // TODO: add event GroupsCreated

        return redirect('/groups')->with('success', 'You have created the group '.$group->name.'!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->update($this->validateRequest($request));
        return redirect('/groups/'.$group->id)->with('success', 'You have edited the group '.$group->name.'!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->members()->detach();
        $group->delete();
        return redirect('/groups')->withErrors(['You have deleted the group '.$group->name.'.']);
    }

    /**
     * Validate the request attributes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|null array of valid attributes or null if request is invalidated
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
        ]);
    }
}
