<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Faskes;
use Illuminate\Http\Request;

class FaskesController extends Controller
{
    // 1. Mengambil semua data fasilitas kesehatan (faskes) mitra kampus
    public function index()
    {
        $faskes = Faskes::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar fasilitas kesehatan berhasil diambil',
            'data'    => $faskes
        ], 200);
    }

    // 2. Menyimpan data faskes baru (jika ada penambahan mitra baru)
    public function store(Request $request)
    {
        $request->validate([
            'nama_faskes' => 'required|string',
            'jenis_faskes'=> 'required|string', // Contoh: Puskesmas, Klinik, Rumah Sakit
            'alamat'      => 'required|string',
            'jarak_km'    => 'required|numeric', // Jarak perkiraan dari kampus
        ]);

        $newFaskes = Faskes::create([
            'nama_faskes' => $request->nama_faskes,
            'jenis_faskes'=> $request->jenis_faskes,
            'alamat'      => $request->alamat,
            'jarak_km'    => $request->jarak_km,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas kesehatan baru berhasil ditambahkan!',
            'data'    => $newFaskes
        ], 201);
    }
}