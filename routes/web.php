<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Halaman Utama otomatis diarahkan ke Dashboard jika sudah login
Route::get('/', function () { 
    return view('dashboard'); 
})->middleware(['auth', 'verified']);

// Mengamankan Dashboard bawaan Breeze agar selaras
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ========================================================
// SEMUA MODUL KESEHATAN DI BAWAH INI WAJIB LOGIN (AUTH)
// ========================================================
Route::middleware('auth')->group(function () {
    
    // Rute Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 1. MODUL REKAM MEDIS
    Route::get('/rekam-medis-view', function () {
        return view('rekam_medis_view', ['data_medis' => \App\Models\RekamMedis::all()]);
    });
    Route::get('/rekam-medis-tambah', function () { return view('tambah_rekam_medis'); });
    Route::post('/rekam-medis-simpan', function (Request $request) {
        \App\Models\RekamMedis::create([
            'nama_pasien' => $request->nama,
            'nim_atau_id' => $request->nim, // Digunakan untuk menyimpan alamat rumah
            'keluhan'     => $request->keluhan,
            'diagnosis'   => 'Dalam pemeriksaan',
            'resep_obat'  => 'Belum ada resep',
        ]);
        return redirect('/rekam-medis-view');
    });
    Route::get('/rekam-medis-delete/{id}', function ($id) {
        \App\Models\RekamMedis::destroy($id);
        return redirect('/rekam-medis-view');
    });

    // 2. MODUL JADWAL DOKTER (Sistem Rekomendasi Pintar)
    Route::get('/jadwal-dokter-view', function () {
        return view('jadwal_dokter_view', ['data_jadwal' => \App\Models\JadwalDokter::all()]);
    });
    Route::get('/jadwal-dokter-tambah', function () { 
        $pilihan_pasien = \App\Models\RekamMedis::all();
        return view('tambah_jadwal_dokter', compact('pilihan_pasien')); 
    });
    Route::post('/jadwal-dokter-simpan', function (Request $request) {
        $rekam_medis = \App\Models\RekamMedis::where('nama_pasien', $request->nama_pasien)->first();
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

        \App\Models\JadwalDokter::create([
            'nama_pasien'         => $request->nama_pasien,
            'nim_atau_id'         => 'Pasien Umum',
            'nama_dokter'         => $nama_dokter,
            'spesialisasi_dokter' => $spesialisasi,
            'tanggal_booking'     => $request->tanggal_booking,
            'jam_booking'         => $request->jam_booking,
            'status_persetujuan'  => 'pending',
        ]);
        return redirect('/jadwal-dokter-view');
    });
    Route::get('/jadwal-dokter-delete/{id}', function ($id) {
        \App\Models\JadwalDokter::destroy($id);
        return redirect('/jadwal-dokter-view');
    });

    // 3. MODUL FASILITAS KESEHATAN (FASKES)
    Route::get('/faskes-view', function () {
        return view('faskes_view', ['data_faskes' => \App\Models\Faskes::all()]);
    });
    Route::get('/faskes-tambah', function () { return view('tambah_faskes'); });
    Route::post('/faskes-simpan', function (Request $request) {
        \App\Models\Faskes::create([
            'nama_faskes'   => $request->nama_faskes,
            'jenis_faskes'  => $request->jenis_faskes,
            'alamat'        => $request->alamat,
        ]);
        return redirect('/faskes-view');
    });
    Route::get('/faskes-delete/{id}', function ($id) {
        \App\Models\Faskes::destroy($id);
        return redirect('/faskes-view');
    });

    // 4. MODUL RESEP OBAT (Racik Otomatis)
    Route::get('/resep-obat-view', function () {
        return view('resep_obat_view', ['data_resep' => \App\Models\ResepObat::all()]);
    });
    Route::get('/resep-obat-tambah', function () { 
        $pilihan_pasien = \App\Models\RekamMedis::all();
        return view('tambah_resep_obat', compact('pilihan_pasien')); 
    });
    Route::post('/resep-obat-simpan', function (Request $request) {
        $rekam_medis = \App\Models\RekamMedis::where('nama_pasien', $request->nama_pasien)->first();
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
        } elseif (str_contains($keluhan, 'lambung') || str_contains($keluhan, 'maag')) {
            $nama_obat = 'Antasida Doen / Omeprazole';
            $aturan_pakai = '3x1 hari (30 menit sebelum makan)';
            $harga = 12000;
        }

        \App\Models\ResepObat::create([
            'nama_pasien'         => $request->nama_pasien,
            'nim_atau_id'         => 'Pasien Umum',
            'nama_obat'           => $nama_obat,
            'jumlah'              => $request->jumlah,
            'aturan_pakai'        => $aturan_pakai,
            'estimasi_harga_obat' => $harga * $request->jumlah,
        ]);
        return redirect('/resep-obat-view');
    });
    Route::get('/resep-obat-delete/{id}', function ($id) {
        \App\Models\ResepObat::destroy($id);
        return redirect('/resep-obat-view');
    });

});

require __DIR__.'/auth.php';