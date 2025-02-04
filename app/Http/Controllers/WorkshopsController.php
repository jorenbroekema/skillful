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
        $workshops = $this->customSortAllWorkshops();
        return view('workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        if ($attributes['start_date'] > $attributes['end_date']) {
            return back()->withErrors(['Your start date cannot be later than your end date.']);
        }

        $workshop = new Workshop($attributes);
        if (!$request->get('group') || $request->get('public') === 'on') {
            $workshop->public = true;
        }
        $workshop->save();

        $workshop->owner()->associate(auth()->user());
        $group = Group::where('id', $request->get('group'))->first();
        $workshop->group()->associate($group);
        $workshop->save();

        return redirect('/workshops')->with('success', 'You have created the workshop '.$workshop->title.'!');
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
        return redirect('/workshops/'.$workshop->id)
            ->with('success', 'You have edited the workshop '.$workshop->name.'!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->users()->detach();
        $workshop->owner()->dissociate();
        $workshop->delete();
        return redirect('/workshops')->withErrors(['You have deleted the workshop '.$workshop->name.'.']);
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

    private function customSortAllWorkshops()
    {
        // TODO: Sort by closest start_date first
        $allWorkshops = Workshop::all()->keyBy('id');
        $user = auth()->user();
        $workshops = collect();

        if ($user) {
            // Add owned workshops
            $user->ownedWorkshops()->get()->each(
                function ($workshop) use ($allWorkshops, $user, $workshops) {
                    $workshopToAdd = $allWorkshops->pull($workshop->id);
                    $workshops->push($workshopToAdd);
                }
            );

            // Add workshops in your group
            $allWorkshops->each(
                function ($workshop) use ($allWorkshops, $user, $workshops) {
                    if ($workshop->sharesGroupWith($user, true)) {
                        $workshopToAdd = $allWorkshops->pull($workshop->id);
                        $workshops->push($workshopToAdd);
                    }
                }
            );
        }

        $allWorkshops->each(
            function ($workshop) use ($workshops) {
                $workshops->push($workshop);
            }
        );

        return $workshops;
    }
}
