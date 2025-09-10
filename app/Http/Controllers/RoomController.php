<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua data Room.
     *
     * Mengambil seluruh data Room dari database menggunakan Eloquent ORM (`Room::all()`),
     * lalu mengirimkan data tersebut ke view `rooms.index` dalam bentuk variabel `$rooms`.
     *
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat Room baru.
     *
     * Mengembalikan view `rooms.create` yang berisi form input data Room.
     *
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data Room baru ke database.
     *
     * Melakukan validasi input, kemudian menyimpan data Room baru menggunakan Eloquent ORM.
     * Setelah berhasil, redirect ke halaman daftar Room dengan pesan sukses.
     *
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
     * Menampilkan detail Room tertentu.
     *
     * Mengambil data Room beserta relasi bookings, lalu mengirimkan ke view `rooms.show`.
     * Find => Mengambil satu data model berdasarkan primary key (id).Jika data tidak ditemukan, mengembalikan null.
     */
    public function show(Room $room)
    {
        $room = Room::with('bookings')->find($room->id);
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit Room tertentu.
     *
     * Mengambil data Room berdasarkan ID, lalu mengirimkan ke view `rooms.edit`.
     *findOrFail($id) => Mengambil data berdasarkan primary key (id).
      Jika data tidak ditemukan, melempar exception (ModelNotFoundException) sehingga biasanya menghasilkan error 404.
     */
    public function edit(Room $room)
    {
        $room = Room::findorFail($room->id);
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data Room di database.
     *
     * Melakukan validasi input, kemudian memperbarui data Room yang dipilih.
     * Setelah berhasil, redirect ke halaman daftar Room dengan pesan sukses.
     *
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
     * Menghapus data Room dari database.
     *
     * Menghapus Room berdasarkan ID, lalu redirect ke halaman daftar Room dengan pesan sukses.
     *
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')
                         ->with('success', 'Room deleted successfully.');
    }
}