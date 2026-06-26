<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    // Mengarahkan ke nama tabel database asli kamu
    protected $table = 'jadwal_dokter'; 

    protected $fillable = [
        'nama_pasien', 
        'nim_atau_id', 
        'nama_dokter', 
        'spesialisasi_dokter', 
        'tanggal_booking', 
        'jam_booking', 
        'status_persetujuan'
    ];
}