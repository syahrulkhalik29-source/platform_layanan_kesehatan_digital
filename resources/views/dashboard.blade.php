<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Dashboard Utama Portal Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-teal-50 via-slate-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-teal-700 to-cyan-800 overflow-hidden shadow-xl sm:rounded-2xl p-8 mb-10 text-center text-white relative">
                <div class="absolute top-0 right-0 -mt-6 -me-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -mb-6 -ms-6 w-24 h-24 bg-white opacity-10 rounded-full"></div>

                <h1 class="text-3xl font-extrabold mb-3 tracking-wide">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>
                <p class="text-teal-100 max-w-2xl mx-auto text-base leading-relaxed">
                    Platform Layanan Kesehatan Digital Kelompok Binary. Sistem informasi modular terintegrasi untuk pengelolaan layanan kesehatan, integrasi API faskes, dan otomatisasi infrastruktur cloud Render.
                </p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-700 flex items-center space-x-2">
                    <span class="inline-block w-2 h-5 bg-teal-600 rounded"></span>
                    <span>Modul Layanan & Fitur Utama</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-blue-500 hover:shadow-lg hover:bg-blue-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-blue-100 rounded-xl text-blue-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Manajemen Pengguna</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Kelola hak akses data dan token keamanan Laravel Sanctum untuk role Pasien dan Tenaga Medis.</p>
                    </div>
                    <span class="text-xs font-semibold px-2 py-1 bg-blue-100 text-blue-800 rounded-md self-start">Fitur 1 — Internal</span>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-emerald-500 hover:shadow-lg hover:bg-emerald-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Pencarian Faskes</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Integrasi live data eksternal BPJS Kesehatan API / Satusehat API untuk pemetaan lokasi klinik terdekat.</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xs font-semibold px-2 py-1 bg-emerald-100 text-emerald-800 rounded-md">Fitur 2 — External API</span>
                        <a href="{{ url('/faskes-view') }}" class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700 hover:underline">Buka Menu <span class="ms-1">→</span></a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-purple-500 hover:shadow-lg hover:bg-purple-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-purple-100 rounded-xl text-purple-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Reservasi Janji Temu</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Sistem pemesanan jadwal temu dokter praktis dengan validasi kuota otomatis secara real-time.</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xs font-semibold px-2 py-1 bg-purple-100 text-purple-800 rounded-md">Fitur 3 — Internal</span>
                        <a href="{{ url('/jadwal-dokter-view') }}" class="inline-flex items-center text-sm font-bold text-purple-600 hover:text-purple-700 hover:underline">Buka Menu <span class="ms-1">→</span></a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-amber-500 hover:shadow-lg hover:bg-amber-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-amber-100 rounded-xl text-amber-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Rekam Medis Digital</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Penyimpanan riwayat kesehatan rileks, keluhan diagnosis, dan rekapitulasi medis mandiri terproteksi.</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xs font-semibold px-2 py-1 bg-amber-100 text-amber-800 rounded-md">Fitur 4 — Internal</span>
                        <a href="{{ url('/rekam-medis-view') }}" class="inline-flex items-center text-sm font-bold text-amber-600 hover:text-amber-700 hover:underline">Buka Menu <span class="ms-1">→</span></a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-cyan-500 hover:shadow-lg hover:bg-cyan-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-cyan-100 rounded-xl text-cyan-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Manajemen Resep Obat</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Fitur penunjang optimasi takaran dosis obat serta kalkulasi harga otomatis untuk mempermudah tebus resep.</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xs font-semibold px-2 py-1 bg-cyan-100 text-cyan-800 rounded-md">Fitur Tambahan — Internal</span>
                        <a href="{{ url('/resep-obat-view') }}" class="inline-flex items-center text-sm font-bold text-cyan-600 hover:text-cyan-700 hover:underline">Buka Menu <span class="ms-1">→</span></a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border-l-4 border-rose-500 hover:shadow-lg hover:bg-rose-50/30 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-rose-100 rounded-xl text-rose-600 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Infrastruktur & DevOps</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Status Integrasi: <strong class="text-emerald-600">ONLINE (Render Cloud)</strong>. Terhubung otomatis melalui pipeline penarikan kode berkelanjutan (*CI/CD*) langsung dari repositori GitHub.</p>
                    </div>
                    <span class="text-xs font-semibold px-2 py-1 bg-rose-100 text-rose-800 rounded-md self-start">Fitur 5 — DevOps Environment</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>