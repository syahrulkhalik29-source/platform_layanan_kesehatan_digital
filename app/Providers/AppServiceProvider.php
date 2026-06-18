<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Mengikat layanan ke dalam Service Container sesuai nama proyek asli
        $this->app->bind('platform_layanan_kesehatan_digital', function ($app) {
            return "Service Container & Provider untuk platform_layanan_kesehatan_digital Aktif!";
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
