<?php

namespace App\Services;

use App\Contracts\FaskesContract;
use Illuminate\Support\Facades\Http;

class FaskesService implements FaskesContract
{
    public function getAll()
    {
        // 1. Backend meminta izin/handshake ke Third-Party API eksternal
        $response = Http::get('https://api.kemenkes.go.id/v1/faskes-mock'); // Contoh URL API luar

        if ($response->successful()) {
            return $response->json()['data'];
        }

        // 2. Jika API eksternal down/gagal, kembalikan data cadangan dengan format yang sesuai dengan HTML
        return [
            [
                'nama_faskes' => 'Puskesmas Kuta Alam',
                'jenis_faskes' => 'Puskesmas',
                'alamat' => 'Jl. Ahmad Yani No.2, Banda Aceh',
                'sumber' => 'BPJS-GATEWAY V4'
            ],
            [
                'nama_faskes' => 'RSUD Meuraxa',
                'jenis_faskes' => 'Rumah Sakit',
                'alamat' => 'Jl. Soekarno-Hatta, Banda Aceh',
                'sumber' => 'SATUSEHAT-API'
            ],
            [
                'nama_faskes' => 'Klinik Pratama Ar-Raniry',
                'jenis_faskes' => 'Klinik',
                'alamat' => 'Lingkungan Kampus UIN Ar-Raniry, Kopelma Darussalam',
                'sumber' => 'SINKRON-INTERNAL'
            ]
        ];
    }

    public function storeData(array $data)
    {
        return \App\Models\Faskes::create($data);
    }
}