<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // 1. Fungsi untuk MENAMPILKAN semua data rekam medis
    public function index()
    {
        $rekamMedis = RekamMedis::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar rekam medis berhasil diambil',
            'data'    => $rekamMedis
        ], 200);
    }

    // 2. Fungsi untuk MENYIMPAN data rekam medis baru
    public function store(Request $request)
    {
        // Validasi data inputan dasar mahasiswa
        $request->validate([
            'nama_pasien' => 'required|string',
            'nim_atau_id' => 'required|string',
            'keluhan'     => 'required|string',
            'diagnosis'   => 'required|string',
            'catatan_obat'=> 'nullable|string',
        ]);

        // Simpan ke database
        $rekamMedis = RekamMedis::create([
            'nama_pasien' => $request->nama_pasien,
            'nim_atau_id' => $request->nim_atau_id,
            'keluhan'     => $request->keluhan,
            'diagnosis'   => $request->diagnosis,
            'catatan_obat'=> $request->catatan_obat,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil ditambahkan!',
            'data'    => $rekamMedis
        ], 201);
    }
}