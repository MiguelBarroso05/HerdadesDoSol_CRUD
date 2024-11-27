<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\User;

class ActivityController extends Controller
{
    public function index()
    {
        return view('activities.activities', ['activities' => Activity::withoutTrashed()->get()]);
    }

    public function create(){
        return view('activities.create');
    }

    public function store(ActivityRequest $request){

        $validated = $request->validated();

        try{
            $activity = new Activity($validated);
            $activity->save();
            return redirect()->route('activities.index')->with('success', 'Activity created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Activity $activity){
        return view('activities.show',['activity'=>$activity]);
    }

    public function edit(Activity $activity){
        return view('activities.edit',['activity'=>$activity]);
    }

    public function update(ActivityRequest $request, Activity $activity){
        try{
            $activity->update($request->validated());
            return redirect()->route('activities.index')->with('success', 'Activity updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Activity $activity){
        $activity->delete();
        return redirect()->route('activities.index');
    }
}
