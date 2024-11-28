<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityTypeRequest;
use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('activity_types.activity_types', ['activity_types' => ActivityType::withoutTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityTypeRequest $request)
    {
        $validated = $request->validated();
        try{
            $activity_type = new ActivityType($validated);
            $activity_type->save();
            return redirect()->route('activity_types.index')->with('success', 'Activity Type created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityType $activity_type)
    {
        return view('activity_types.show', ['activity_type' => $activity_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityType $activity_type)
    {
        return view('activity_types.edit', ['activity_type' => $activity_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityTypeRequest $request, $id)
    {
        $activity_type = ActivityType::all()->findOrFail($id);
        try{
            $activity_type->update($request->validated());
            return redirect()->route('activity_types.index')->with('success', 'Activity Type updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityType $activity_type)
    {
        $activity_type->delete();
        return redirect()->route('activity_types.index');
    }
}
