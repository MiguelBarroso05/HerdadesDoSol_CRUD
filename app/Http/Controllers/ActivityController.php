<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\UserRequest;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\User;

class ActivityController extends Controller
{
    public function index()
    {
        //$activities = Activity::with('activity_types')->get();
        $activities = Activity::with('activity_types')->paginate(8);
        return view('activities.activities', compact('activities'));
    }

    public function create()
    {
        $activity_types = ActivityType::withoutTrashed()->get();
        return view('activities.create', compact('activity_types'));
    }

    public function store(ActivityRequest $request)
    {
        $validated = $request->validated();
        try {
            $activity = new Activity($validated);
            $activity->save();

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $activity->id . '_' . preg_replace('/\s+/', '', $activity->name) . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('activities', $filename, 'public');
                $activity->img = $url;
                $activity->save();
            }
            return redirect()->route('activities.index')->with('success', 'Activity Type created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Activity $activity)
    {
        return view('activities.show', ['activity' => $activity]);
    }

    public function edit(Activity $activity)
    {
        $activity_types = ActivityType::withoutTrashed()->get();
        return view('activities.edit', compact('activity', 'activity_types'));
    }

    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        try {
            $validated = $request->validated();
            $dataToUpdate = $validated;
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $activity->id . '_' . $activity->name . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('activities', $filename, 'public');
                $dataToUpdate['img'] = $url;
            }
            $activity->update($dataToUpdate);

            return redirect()->route('activities.index')->with('success', 'Activity updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index');
    }
}
