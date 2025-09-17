<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua data Booking.
     *
     * Mengambil semua data Booking lengkap dengan relasi Room dan User menggunakan Eloquent ORM.
     * Juga mengambil semua Room dan User untuk kebutuhan form tambah Booking.
     *
     */
    public function index()
    {
        // ambil booking lengkap dengan relasi room & user
        $bookings = Booking::with(['room', 'user'])->get();

        // ambil semua room & user untuk form tambah booking
        $rooms = Room::all();
        $users = User::all();

        return view('bookings.index', compact('bookings', 'rooms', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat Booking baru.
     * Mengembalikan view `bookings.create` yang berisi form input data Booking.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data Booking baru ke database.
     * Melakukan validasi input, kemudian menyimpan data Booking baru menggunakan Eloquent ORM.
     * Setelah berhasil, redirect ke halaman daftar Booking dengan pesan sukses.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

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
     * Menampilkan detail Booking tertentu.
     * Mengambil data Booking beserta relasi rooms, lalu mengirimkan ke view `bookings.show`.
     */
    public function show(Booking $booking)
    {
        $booking = Booking::with('rooms')->find($booking->id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit Booking tertentu.
     * Mengambil data Booking berdasarkan ID, lalu mengirimkan ke view `bookings.edit
     */
    public function edit(Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $booking = Booking::findorFail($booking->id);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     * Melakukan validasi input, kemudian memperbarui data Booking yang dipilih.
     * Setelah berhasil, redirect ke halaman daftar Booking dengan pesan sukses.
     * 
     */
    public function update(Request $request, Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

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
     * Menghapus Booking berdasarkan ID, lalu redirect ke halaman daftar Booking dengan pesan sukses.
     * 
     */
    public function destroy(Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $booking->delete();
        return redirect()->route('bookings.index')
                         ->with('success', 'Booking deleted successfully.');
    }
}
