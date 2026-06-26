<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    // 1. Mengambil semua daftar jadwal dokter yang tersedia
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar jadwal dokter berhasil diambil',
            'data'    => $jadwal
        ], 200);
    }

    // 2. Menyimpan data booking janji temu dari mahasiswa/pasien
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'   => 'required|string',
            'spesialis'     => 'required|string',
            'hari_praktik'  => 'required|string',
            'jam_praktik'   => 'required|string',
        ]);

        $booking = JadwalDokter::create([
            'nama_dokter'   => $request->nama_dokter,
            'spesialis'     => $request->spesialis,
            'hari_praktik'  => $request->hari_praktik,
            'jam_praktik'   => $request->jam_praktik,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking jadwal dokter berhasil dibuat!',
            'data'    => $booking
        ], 201);
    }
}