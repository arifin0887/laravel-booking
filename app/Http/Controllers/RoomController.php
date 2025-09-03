<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_room' => 'required|string|max:255|unique:rooms',
            'price' => 'required|integer|min:100',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,booked',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room = Room::with('bookings')->find($room->id);
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room = Room::findorFail($room->id);
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name_room' => 'required|string|max:255|unique:rooms,name_room,' . $room->id,
            'price' => 'required|integer|min:100',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,booked',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')
                         ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')
                         ->with('success', 'Room deleted successfully.');
    }
}
