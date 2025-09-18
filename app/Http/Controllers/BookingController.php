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
     * LOGIKA BARU: Menampilkan data berdasarkan peran pengguna.
     */
    public function index()
    {
        // Ambil semua room dan user, ini dibutuhkan untuk form modal admin
        $rooms = Room::all();
        $users = User::all();

        if (auth()->user()->role === 'admin') {
            // Jika admin, ambil semua data booking
            $bookings = Booking::with(['room', 'user'])->latest()->get();
        } else {
            // Jika bukan admin, hanya ambil booking milik pengguna yang sedang login
            $bookings = Booking::with(['room', 'user'])
                                ->where('user_id', auth()->id())
                                ->latest()
                                ->get();
        }

        // Kirim data yang sudah difilter ke view
        return view('bookings.index', compact('bookings', 'rooms', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     * LOGIKA BARU: Membedakan penyimpanan antara Admin dan User.
     */
    public function store(Request $request)
    {
        // Aturan validasi dasar
        $rules = [
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string|max:500',
        ];

        // Jika yang membuat adalah admin, tambahkan aturan validasi untuk user_id dan status
        if (auth()->user()->role === 'admin') {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['status'] = 'required|string|in:pending,confirmed,cancelled';
        }

        $request->validate($rules);

        // Siapkan data untuk disimpan
        $data = $request->all();

        // Jika yang membuat BUKAN admin, user_id diambil dari pengguna yang login dan status defaultnya 'pending'
        if (auth()->user()->role !== 'admin') {
            $data['user_id'] = auth()->id();
            $data['status'] = 'pending'; // Status default untuk user
        }

        Booking::create($data);

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking created successfully.');
    }


    // --- Method lainnya bisa dibiarkan seperti yang sudah Anda buat, karena sudah bagus ---
    // --- Pastikan proteksi `!auth()->user()->isAdmin()` tetap ada di method sensitif seperti update & destroy ---

    public function show(Booking $booking)
    {
        // Proteksi agar user hanya bisa melihat booking miliknya
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $booking = Booking::with('room')->find($booking->id);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('bookings.edit', compact('booking'));
    }
    
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