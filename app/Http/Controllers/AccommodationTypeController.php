<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationTypeRequest;
use App\Models\AccommodationType;
use Illuminate\Http\Request;

class AccommodationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('accommodation_types.accommodation_types', ['accommodation_types' => AccommodationType::withoutTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accommodation_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccommodationTypeRequest $request)
    {
        $validated = $request->validated();
        try{
            $room_type = new AccommodationType($validated);
            $room_type->save();
            return redirect()->route('accommodation_types.index')->with('success', 'accommodation_types created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AccommodationType $room_type)
    {
        return view('accommodation_types.show', ['room_type' => $room_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationType $room_type)
    {
        return view('accommodation_types.edit', ['room_type' => $room_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationTypeRequest $request, $id)
    {
        $room_type = AccommodationType::all()->findOrFail($id);
        try{
            $room_type->update($request->validated());
            return redirect()->route('accommodation_types.index')->with('success', 'Room Type updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationType $room_type)
    {
        $room_type->delete();
        return redirect()->route('accommodation_types.index');
    }
}
