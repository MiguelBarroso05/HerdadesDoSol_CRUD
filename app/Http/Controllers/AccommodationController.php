<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\UserRequest;
use App\Models\Accommodation;
use App\Models\Activity;
use App\Models\AccommodationType;
use App\Models\User;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodations = Accommodation::with('accommodation_types')->get();
        return view('accommodations.accommodations', compact('accommodations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accommodation_types = AccommodationType::withoutTrashed()->get();
        return view('accommodations.create', compact('accommodation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccommodationRequest $request)
    {
        $validated = $request->validated();

        try{
            $accommodation = new Accommodation($validated);
            $accommodation->save();
            return redirect()->route('accommodations.index')->with('success', 'Accommodation created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        return view('accommodations.show', ['accommodation' => $accommodation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accommodation $accommodation)
    { //dd($accommodation);
        $accommodation_types = AccommodationType::withoutTrashed()->get();
        return view('accommodations.edit', compact('accommodation','accommodation_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccommodationRequest $request, $id)
    {
        $accommodation = Accommodation::all()->findOrFail($id);
        try{
            $accommodation->update($request->validated());
            return redirect()->route('accommodations.index')->with('success', 'Accommodation updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        return redirect()->route('accommodations.index');
    }
}
