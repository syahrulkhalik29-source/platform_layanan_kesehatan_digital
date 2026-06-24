<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama Portal Kesehatan') }}
        </h2>
    </x-slot>

    <!-- Menggunakan Bootstrap via CDN untuk style menu kotak kemarin -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-card { transition: transform 0.2s, box-shadow 0.2s; cursor: pointer; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important; }
        .icon-box { font-size: 3rem; margin-bottom: 15px; }
        a { text-decoration: none !important; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Banner Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 text-center mb-5 border-bottom">
                <h1 class="display-6 fw-bold text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="lead text-muted mx-auto mt-2" style="max-width: 600px;">
                    Sistem informasi layanan kesehatan terintegrasi untuk pengelolaan rekam medis, booking jadwal dokter pintar, faskes mitra, dan resep obat otomatis.
                </p>
            </div>

            <!-- Grid Menu Navigasi Utama -->
            <div class="container mb-5">
                <div class="row g-4 justify-content-center">
                    
                    <!-- Menu 1: Rekam Medis -->
                    <div class="col-md-5 col-lg-3">
                        <div class="card h-100 text-center shadow-sm border-0 menu-card" onclick="window.location.href='/rekam-medis-view'">
                            <div class="card-body p-4">
                                <div class="icon-box">📁</div>
                                <h5 class="card-title fw-bold text-dark">Rekam Medis</h5>
                                <p class="card-text text-muted small">Kelola data riwayat penyakit, alamat, dan diagnosis awal pasien umum.</p>
                                <div class="btn btn-sm btn-primary w-100 fw-bold mt-2">Buka Modul</div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu 2: Jadwal Dokter -->
                    <div class="col-md-5 col-lg-3">
                        <div class="card h-100 text-center shadow-sm border-0 menu-card" onclick="window.location.href='/jadwal-dokter-view'">
                            <div class="card-body p-4">
                                <div class="icon-box">📅</div>
                                <h5 class="card-title fw-bold text-dark">Jadwal Dokter</h5>
                                <p class="card-text text-muted small">Booking jadwal temu medis dengan rekomendasi dokter spesialis otomatis.</p>
                                <div class="btn btn-sm btn-primary w-100 fw-bold mt-2">Buka Modul</div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu 3: Resep Obat -->
                    <div class="col-md-5 col-lg-3">
                        <div class="card h-100 text-center shadow-sm border-0 menu-card" onclick="window.location.href='/resep-obat-view'">
                            <div class="card-body p-4">
                                <div class="icon-box">💊</div>
                                <h5 class="card-title fw-bold text-dark">Resep Obat</h5>
                                <p class="card-text text-muted small">Rekap aturan pakai, dosis, dan kalkulasi estimasi harga obat otomatis.</p>
                                <div class="btn btn-sm btn-primary w-100 fw-bold mt-2">Buka Modul</div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu 4: Fasilitas Kesehatan -->
                    <div class="col-md-5 col-lg-3">
                        <div class="card h-100 text-center shadow-sm border-0 menu-card" onclick="window.location.href='/faskes-view'">
                            <div class="card-body p-4">
                                <div class="icon-box">🏢</div>
                                <h5 class="card-title fw-bold text-dark">Fasilitas Kesehatan</h5>
                                <p class="card-text text-muted small">Pantau daftar klinik, apotek, dan faskes mitra yang tersedia bagi publik.</p>
                                <div class="btn btn-sm btn-primary w-100 fw-bold mt-2">Buka Modul</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>