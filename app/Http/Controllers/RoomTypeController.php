<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTypeRequest;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room_types.room_types', ['room_types' => RoomType::withoutTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomTypeRequest $request)
    {
        $validated = $request->validated();
        try{
            $room_type = new RoomType($validated);
            $room_type->save();
            return redirect()->route('room_types.index')->with('success', 'room_types created successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $room_type)
    {
        return view('room_types.show', ['room_type' => $room_type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $room_type)
    {
        return view('room_types.edit', ['room_type' => $room_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomTypeRequest $request, $id)
    {
        $room_type = RoomType::all()->findOrFail($id);
        try{
            $room_type->update($request->validated());
            return redirect()->route('room_types.index')->with('success', 'Room Type updated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $room_type)
    {
        $room_type->delete();
        return redirect()->route('room_types.index');
    }
}
