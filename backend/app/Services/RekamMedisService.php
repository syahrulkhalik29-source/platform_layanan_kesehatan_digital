<?php

namespace App\Services;

use App\Contracts\RekamMedisContract;
use App\Models\RekamMedis;

class RekamMedisService implements RekamMedisContract
{
    public function getAllByUserId($userId)
    {
        $rekam = RekamMedis::where('user_id', $userId)->get();

        if ($rekam->isEmpty()) {
            return [
                [
                    'id' => 1,
                    'keluhan' => 'Demam tinggi selama 3 hari disertai sakit kepala berat',
                    'diagnosa' => 'Gejala Gejala Influenza / Suspect Dengue',
                    'created_at' => now()->toFormattedDateString()
                ]
            ];
        }

        return $rekam;
    }

    public function storeData(array $data)
    {
        return RekamMedis::create($data);
    }

    public function deleteData($id)
    {
        $rekam = RekamMedis::find($id);
        if ($rekam) {
            return $rekam->delete();
        }
        return false;
    }
}