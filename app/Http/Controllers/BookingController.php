<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|string|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking = Booking::with('rooms')->find($booking->id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $booking = Booking::findorFail($booking->id);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|string|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')
                         ->with('success', 'Booking deleted successfully.');
    }
}
