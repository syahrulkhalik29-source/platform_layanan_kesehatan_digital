<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    // Tambahkan baris ini untuk membuka izin input database
    protected $fillable = ['nama_pasien', 'nim_atau_id', 'keluhan', 'diagnosis', 'resep_obat'];
}