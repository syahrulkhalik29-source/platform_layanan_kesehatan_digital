<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\RekamMedisContract;
use App\Contracts\FaskesContract;
use App\Contracts\JadwalDokterContract;
use App\Contracts\ResepObatContract;

class LayananKesehatanController extends Controller
{
    protected $rekamMedisService;
    protected $faskesService;
    protected $jadwalDokterService;
    protected $resepObatService;

    public function __construct(
        RekamMedisContract $rekamMedisService,
        FaskesContract $faskesService,
        JadwalDokterContract $jadwalDokterService,
        ResepObatContract $resepObatService
    ) {
        $this->rekamMedisService = $rekamMedisService;
        $this->faskesService = $faskesService;
        $this->jadwalDokterService = $jadwalDokterService;
        $this->resepObatService = $resepObatService;
    }

    // ==========================================
    // MODUL 0: AUTHENTICATION API (DIBUTUHKAN TESTING)
    // ==========================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kredensial salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    // ==========================================
    // MODUL 1: REKAM MEDIS
    // ==========================================
    public function getRekamMedis(Request $request)
    {
        $user = $request->user();
        $rekamMedis = $this->rekamMedisService->getAllByUserId($user->id);

        return response()->json([
            'status' => 'success',
            'data' => $rekamMedis
        ]);
    }

    public function storeRekamMedis(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $rekam = $this->rekamMedisService->storeData($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data rekam medis berhasil disimpan',
            'data' => $rekam
        ], 201);
    }

    public function deleteRekamMedis($id)
    {
        $deleted = $this->rekamMedisService->deleteData($id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data rekam medis berhasil dihapus'
        ]);
    }

    // ==========================================
    // MODUL 2: FASILITAS KESEHATAN (FASKES)
    // ==========================================
    public function getFaskes()
    {
        $faskes = $this->faskesService->getAll();
        return response()->json([
            'status' => 'success',
            'data' => $faskes
        ]);
    }

    public function storeFaskes(Request $request)
    {
        $request->validate([
            'nama_faskes' => 'required|string',
            'alamat' => 'required|string',
            'tipe' => 'required|string',
        ]);

        $faskes = $this->faskesService->storeData($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Faskes berhasil ditambahkan',
            'data' => $faskes
        ], 201);
    }

    // ==========================================
    // MODUL 3: JADWAL DOKTER
    // ==========================================
    public function getJadwalDokter()
    {
        $jadwal = $this->jadwalDokterService->getAll();
        return response()->json([
            'status' => 'success',
            'data' => $jadwal
        ]);
    }

    public function storeJadwalDokter(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|string',
            'spesialis' => 'required|string',
            'jam_praktik' => 'required|string',
        ]);

        $jadwal = $this->jadwalDokterService->storeData($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal dokter berhasil disimpan',
            'data' => $jadwal
        ], 201);
    }

    // ==========================================
    // MODUL 4: RESEP OBAT
    // ==========================================
    public function getResepObat(Request $request)
    {
        $user = $request->user();
        $resep = $this->resepObatService->getAllByUserId($user->id);

        return response()->json([
            'status' => 'success',
            'data' => $resep
        ]);
    }

    public function storeResepObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'dosis' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $resep = $this->resepObatService->storeData($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Resep obat berhasil ditambahkan',
            'data' => $resep
        ], 201);
    }
}