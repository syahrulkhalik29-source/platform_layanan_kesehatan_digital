<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

// Import Semua Contract
use App\Contracts\RekamMedisContract;
use App\Contracts\FaskesContract;
use App\Contracts\JadwalDokterContract;
use App\Contracts\ResepObatContract;

// Import Semua Service
use App\Services\RekamMedisService;
use App\Services\FaskesService;
use App\Services\JadwalDokterService;
use App\Services\ResepObatService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 1. Binding Rekam Medis
        $this->app->bind(RekamMedisContract::class, function (Application $app) {
            return new RekamMedisService();
        });

        // 2. Binding Faskes
        $this->app->bind(FaskesContract::class, function (Application $app) {
            return new FaskesService();
        });

        // 3. Binding Jadwal Dokter
        $this->app->bind(JadwalDokterContract::class, function (Application $app) {
            return new JadwalDokterService();
        });

        // 4. Binding Resep Obat
        $this->app->bind(ResepObatContract::class, function (Application $app) {
            return new ResepObatService();
        });
    }

    public function boot(): void
    {
        //
    }
}