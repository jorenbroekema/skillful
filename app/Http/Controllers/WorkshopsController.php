<?php

namespace App\Http\Controllers;

use App\Group;
use App\Workshop;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Workshop::class, 'workshop');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::all();
        return view('workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // FIXME: this doesn't work for some reason.... always unauthorized
        // $this->authorize('create');
        return view('workshops.create');
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

        $workshop = Workshop::create($attributes);
        $workshop->public = $request->get('public') === 'on' ? true : false;
        $workshop->owner()->associate(auth()->user());

        // If a group was given, set it. Else, set the id to 0.
        // TODO: Consider making nullable instead so this check is not necessary
        if ($request->get('group')) {
            $group = Group::where('id', $request->get('group'))->first();
            $workshop->group()->associate($group);
        } else {
            $workshop->group_id = 0;
        }
        $workshop->save();

        return redirect('/workshops');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        // $this->authorize('view', $workshop);
        return view('workshops.show', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        // $this->authorize('update', $workshop);
        $workshop->update($this->validateRequest($request));
        return redirect('/workshops');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();

        return redirect('workshops');
    }

    /**
     * Validate the request attributes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|null array of valid attributes or null if request is invalidated
     */
    protected function validateRequest(Request $request)
    {
        $validationCriteria = [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'difficulty' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];

        return $request->validate($validationCriteria);
    }
}
