<?php

namespace App\Services;

use App\Contracts\ResepObatContract;
use App\Models\ResepObat;

class ResepObatService implements ResepObatContract
{
    public function getAllByUserId($userId)
    {
        $resep = ResepObat::where('user_id', $userId)->get();

        if ($resep->isEmpty()) {
            return [
                [
                    'nama_obat' => 'Paracetamol 500mg',
                    'dosis' => '3 x 1 Sehari',
                    'keterangan' => 'Diminum setelah makan jika demam'
                ],
                [
                    'nama_obat' => 'Vitamin C 500mg',
                    'dosis' => '1 x 1 Sehari',
                    'keterangan' => 'Diminum pagi hari untuk menjaga imunitas'
                ]
            ];
        }

        return $resep;
    }

    public function storeData(array $data)
    {
        return ResepObat::create($data);
    }
}