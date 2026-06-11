<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ResepObat;
use Illuminate\Http\Request;

class ResepObatController extends Controller
{
    // 1. Mengambil semua data e-resep mahasiswa
    public function index()
    {
        $resep = ResepObat::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar e-resep obat berhasil diambil',
            'data'    => $resep
        ], 200);
    }

    // 2. Menyimpan data resep obat baru yang dikeluarkan oleh dokter
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string',
            'nim'         => 'required|string',
            'nama_obat'   => 'required|string',
            'dosis'       => 'required|string', // Contoh: 3x1 sehari setelah makan
            'keterangan'  => 'nullable|string',
        ]);

        $newResep = ResepObat::create([
            'nama_pasien' => $request->nama_pasien,
            'nim'         => $request->nim,
            'nama_obat'   => $request->nama_obat,
            'dosis'       => $request->dosis,
            'keterangan'  => $request->keterangan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'E-Resep digital baru berhasil dibuat!',
            'data'    => $newResep
        ], 201);
    }
}