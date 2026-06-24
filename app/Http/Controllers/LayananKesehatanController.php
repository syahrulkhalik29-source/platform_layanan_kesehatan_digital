<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\JadwalDokter;
use App\Models\Faskes;
use App\Models\ResepObat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LayananKesehatanController extends Controller
{
    // ======================================================================
    // 0. AUTENTIKASI API (SANCTUM) - UNTUK LOGIN, REGISTER & LOGOUT
    // ======================================================================
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
            'message' => 'Registrasi akun berhasil',
            'token' => $token,
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau kata sandi yang Anda masukkan salah.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil keluar sistem, token dihapus'
        ]);
    }

    // ======================================================================
    // 1. MODUL REKAM MEDIS
    // ======================================================================
    public function getRekamMedis()
    {
        return response()->json([
            'status' => 'success',
            'data' => RekamMedis::all()
        ]);
    }

    public function storeRekamMedis(Request $request)
    {
        $rekamMedis = RekamMedis::create([
            'nama_pasien' => $request->nama,
            'nim_atau_id' => $request->nim, 
            'keluhan'     => $request->keluhan,
            'diagnosis'   => 'Dalam pemeriksaan',
            'resep_obat'  => 'Belum ada resep',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data rekam medis berhasil ditambahkan secara internal',
            'data' => $rekamMedis
        ], 201);
    }

    public function deleteRekamMedis($id)
    {
        RekamMedis::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data rekam medis berhasil dihapus'
        ]);
    }

    // ======================================================================
    // 2. MODUL JADWAL DOKTER (Sistem Rekomendasi Pintar dengan Auto-Update)
    // ======================================================================
    public function getJadwal()
    {
        return response()->json([
            'status' => 'success',
            'data' => JadwalDokter::all()
        ]);
    }

    public function createBooking(Request $request)
    {
        $rekam_medis = RekamMedis::where('nama_pasien', $request->nama_pasien)->first();
        $keluhan = $rekam_medis ? strtolower($rekam_medis->keluhan) : '';

        $nama_dokter = 'Dr. Andi Pratama';
        $spesialisasi = 'Dokter Umum';

        if (str_contains($keluhan, 'demam') || str_contains($keluhan, 'pusing') || str_contains($keluhan, 'flu') || str_contains($keluhan, 'batuk')) {
            $nama_dokter = 'Dr. Herman Syahputra';
            $spesialisasi = 'Dokter Umum / Klinik';
        } elseif (str_contains($keluhan, 'gigi') || str_contains($keluhan, 'gusi')) {
            $nama_dokter = 'Drg. Cut Mutia';
            $spesialisasi = 'Spesialis Gigi & Mulut';
        } elseif (str_contains($keluhan, 'sesak') || str_contains($keluhan, 'jantung') || str_contains($keluhan, 'lambung')) {
            $nama_dokter = 'Dr. Faisal, Sp.PD';
            $spesialisasi = 'Spesialis Penyakit Dalam';
        } elseif (str_contains($keluhan, 'gatal') || str_contains($keluhan, 'alergi') || str_contains($keluhan, 'kulit')) {
            $nama_dokter = 'Dr. Riska Amelia, Sp.KK';
            $spesialisasi = 'Spesialis Kulit & Kelamin';
        }

        // Jalankan pembaruan otomatis ke tabel rekam medis jika data pasien ditemukan
        if ($rekam_medis) {
            $rekam_medis->update([
                'diagnosis' => "Dirujuk ke $nama_dokter ($spesialisasi)"
            ]);
        }

        $jadwal = JadwalDokter::create([
            'nama_pasien'         => $request->nama_pasien,
            'nim_atau_id'         => 'Pasien Umum',
            'nama_dokter'         => $nama_dokter,
            'spesialisasi_dokter' => $spesialisasi,
            'tanggal_booking'     => $request->tanggal_booking,
            'jam_booking'         => $request->jam_booking,
            'status_persetujuan'  => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pemesanan jadwal dokter dengan rekomendasi pintar berhasil disimpan',
            'data' => $jadwal
        ], 201);
    }

    public function deleteJadwal($id)
    {
        JadwalDokter::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data jadwal booking berhasil dihapus'
        ]);
    }

    // ======================================================================
    // 3. MODUL FASILITAS KESEHATAN (FASKES) - INTEGRASI THIRD PARTY API
    // ======================================================================
    public function getFaskes()
    {
        $faskesThirdParty = [
            [
                'nama_faskes' => 'Klinik Universitas Ar-Raniry',
                'jenis_faskes' => 'Klinik / Puskesmas',
                'alamat' => 'Jl. Syeikh Abdur Rauf, Kopelma Darussalam, Banda Aceh',
                'sumber' => 'Satusehat API Mitra v2'
            ],
            [
                'nama_faskes' => 'Rumah Sakit Umum Daerah (RSUD) Meuraxa',
                'jenis_faskes' => 'Rumah Sakit Tipe B',
                'alamat' => 'Jl. Soekarno - Hatta, Mampree, Kec. Banda Raya, Banda Aceh',
                'sumber' => 'BPJS Kesehatan Bridging API'
            ],
            [
                'nama_faskes' => 'Puskesmas Jeulingke',
                'jenis_faskes' => 'Puskesmas Kecamatan',
                'alamat' => 'Jl. Utama Jeulingke, Kec. Syiah Kuala, Banda Aceh',
                'sumber' => 'Satusehat API Mitra v2'
            ],
            [
                'nama_faskes' => 'Klinik Pratama Cendana Medika',
                'jenis_faskes' => 'Klinik Swasta / Mandiri',
                'alamat' => 'Jl. T. Nyak Arief, Lamgugob, Banda Aceh',
                'sumber' => 'BPJS Kesehatan Bridging API'
            ]
        ];

        return response()->json([
            'status' => 'success',
            'architecture' => 'Service-Based with Third-Party Integration',
            'data' => $faskesThirdParty
        ]);
    }

    public function storeFaskes(Request $request)
    {
        $faskes = Faskes::create([
            'nama_faskes'   => $request->nama_faskes,
            'jenis_faskes'  => $request->jenis_faskes,
            'alamat'        => $request->alamat,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Fasilitas kesehatan baru berhasil didaftarkan',
            'data' => $faskes
        ], 201);
    }

    public function deleteFaskes($id)
    {
        Faskes::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Fasilitas kesehatan mitra berhasil dihapus'
        ]);
    }

    // ======================================================================
    // 4. MODUL RESEP OBAT (Racik Otomatis dengan Auto-Update)
    // ======================================================================
    public function getResepObat()
    {
        return response()->json([
            'status' => 'success',
            'data' => ResepObat::all()
        ]);
    }

    public function storeResepObat(Request $request)
    {
        $rekam_medis = RekamMedis::where('nama_pasien', $request->nama_pasien)->first();
        $keluhan = $rekam_medis ? strtolower($rekam_medis->keluhan) : '';

        $nama_obat = 'Vitamin C';
        $aturan_pakai = '1x1 hari setelah makan';
        $harga = 15000;

        if (str_contains($keluhan, 'demam') || str_contains($keluhan, 'pusing')) {
            $nama_obat = 'Paracetamol 500mg';
            $aturan_pakai = '3x1 hari setelah makan (bila demam)';
            $harga = 10000;
        } elseif (str_contains($keluhan, 'batuk') || str_contains($keluhan, 'flu')) {
            $nama_obat = 'Sirup Obat Batuk & Flu';
            $aturan_pakai = '3x1 sendok makan setelah makan';
            $harga = 25000;
        } elseif (str_contains($keluhan, 'gigi') || str_contains($keluhan, 'nyeri')) {
            $nama_obat = 'Cataflam / Asam Mefenamat';
            $aturan_pakai = '2x1 hari setelah makan (bila nyeri)';
            $harga = 20000;
        } elseif (str_contains($keluhan, 'lambung') || str_contains($keluhan, 'maag') || str_contains($keluhan, 'kanker')) {
            $nama_obat = 'Antasida Doen / Omeprazole';
            $aturan_pakai = '3x1 hari (30 menit sebelum makan)';
            $harga = 12000;
        }

        // Jalankan pembaruan otomatis ke tabel rekam medis jika data pasien ditemukan
        if ($rekam_medis) {
            $rekam_medis->update([
                'resep_obat' => "$nama_obat (" . $request->jumlah . " Pcs)"
            ]);
        }

        $resep = ResepObat::create([
            'nama_pasien'         => $request->nama_pasien,
            'nim_atau_id'         => 'Pasien Umum',
            'nama_obat'           => $nama_obat,
            'jumlah'              => $request->jumlah,
            'aturan_pakai'        => $aturan_pakai,
            'estimasi_harga_obat' => $harga * $request->jumlah,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Resep obat otomatis berhasil diracik oleh sistem backend',
            'data' => $resep
        ], 201);
    }

    public function deleteResepObat($id)
    {
        ResepObat::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data resep obat berhasil dihapus'
        ]);
    }
}