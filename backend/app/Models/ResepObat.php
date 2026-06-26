<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    // Mengarahkan ke nama tabel database asli kamu
    protected $table = 'resep_obat'; 

    protected $fillable = [
        'nama_pasien', 
        'nim_atau_id', 
        'nama_obat', 
        'jumlah', 
        'aturan_pakai', 
        'estimasi_harga_obat'
    ];
}