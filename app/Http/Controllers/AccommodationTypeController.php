<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationTypeRequest;
use App\Models\Accommodation;
use App\Models\AccommodationType;

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
            $accommodation_type = new Accommodation($validated);
            $accommodation_type->save();
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $accommodation_type->id . '_' . $accommodation_type->name . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('accommodation_types', $filename, 'public');
                $accommodation_type->img = $url;
                $accommodation_type->save();
            }
            return redirect()->route('accommodation_types.index')->with('success', 'Accommodation type created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AccommodationType $accommodation_type)
    {
        return view('accommodation_types.show', ['accommodation_type' => $accommodation_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationType $accommodation_type)
    {
        return view('accommodation_types.edit', ['accommodation_type' => $accommodation_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationTypeRequest $request, $id)
    {
        $accommodation_type = AccommodationType::all()->findOrFail($id);
        try{
            $accommodation_type->update($request->validated());
            return redirect()->route('accommodation_types.index')->with('success', 'Accommodation Type updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationType $accommodation_type)
    {
        $accommodation_type->delete();
        return redirect()->route('accommodation_types.index');
    }
}
