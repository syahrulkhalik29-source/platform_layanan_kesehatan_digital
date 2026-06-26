<?php

namespace App\Services;

use App\Contracts\JadwalDokterContract;
use App\Models\JadwalDokter;

class JadwalDokterService implements JadwalDokterContract
{
    public function getAll()
    {
        $jadwal = JadwalDokter::all();

        // Jika database lokal masih kosong, berikan data tiruan agar frontend tidak kosong saat didemo
        if ($jadwal->isEmpty()) {
            return [
                [
                    'nama_dokter' => 'dr. Ahmad Munandar, Sp.PD',
                    'spesialis' => 'Spesialis Penyakit Dalam',
                    'jam_praktik' => 'Senin - Kamis, 09:00 - 13:00'
                ],
                [
                    'nama_dokter' => 'dr. Siti Rahmah, Sp.A',
                    'spesialis' => 'Spesialis Anak',
                    'jam_praktik' => 'Senin - Jumat, 14:00 - 17:00'
                ]
            ];
        }

        return $jadwal;
    }

    public function storeData(array $data)
    {
        return JadwalDokter::create($data);
    }
}