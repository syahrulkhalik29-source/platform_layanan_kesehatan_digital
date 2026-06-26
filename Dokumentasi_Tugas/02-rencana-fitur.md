# Rencana Fitur

> Dokumentasikan minimal \\\*\\\*5 fitur utama\\\*\\\* proyek Anda.
> Salin dan ulangi blok di bawah untuk setiap fitur tambahan.

\---

## Fitur 1 — \[Otentikasi \& Manajemen Pengguna]

**Role Penanggung Jawab:** `Backend \& Frontend`

**Sumber Data:** `Internal System`

**Deskripsi \& Ekspektasi:**
`Fitur ini memungkinkan pengguna untuk mendaftarkan akun dan masuk ke dalam sistem. Sistem memiliki dua peran pengguna (role), yaitu Pasien dan Tenaga Medis (Dokter/Admin). Alur kerjanya: pengguna mengisi form di Frontend, data dikirim ke Backend Laravel untuk divalidasi, dan jika sukses, Backend akan mengeluarkan token keamanan (Laravel Sanctum) agar pengguna bisa mengakses halaman khusus sesuai role mereka.`

\---

## Fitur 2 — \[Pencarian Faskes \& Rumah Sakit Terdekat]

**Role Penanggung Jawab:** `Backend \& Frontend`

**Sumber Data:** `Third-Party API — BPJS Kesehatan API / Google Maps API (Kombinasi dengan Wilayah Indonesia API)`

**Deskripsi \& Ekspektasi:**
`Fitur wajib yang mengintegrasikan layanan pihak ketiga untuk menampilkan daftar rumah sakit, puskesmas, atau klinik terdekat berdasarkan wilayah yang dipilih oleh pengguna. Frontend mengirimkan parameter wilayah/koordinat ke Backend, kemudian Backend Laravel akan melakukan request (fetching) ke Third-Party API tersebut. Data yang didapat dari API luar akan diolah dan dirapikan oleh Backend sebelum dikirim kembali ke Frontend untuk ditampilkan ke layar pasien.`

\---

## Fitur 3 — \[Reservasi Janji Temu Dokter (Booking System)]

**Role Penanggung Jawab:** `Backend \& Frontend`

**Sumber Data:** `Internal System`

**Deskripsi \& Ekspektasi:**
`Pasien dapat melihat jadwal praktik dokter yang tersedia dan melakukan booking/janji temu secara digital. Alur kerjanya: Frontend menampilkan daftar dokter dan jadwalnya yang diambil dari database MySQL melalui API Laravel. Pasien memilih jadwal dan menekan tombol konfirmasi. Backend akan memvalidasi kuota dokter pada hari tersebut, mengurangi slot yang tersedia di database, dan menyimpan data reservasi baru.`

\---

## Fitur 4 — \[Pencatatan Rekam Medis Digital Mandiri]

**Role Penanggung Jawab:** `Backend \& Frontend`

**Sumber Data:** `Internal System`

**Deskripsi \& Ekspektasi:**
`Fitur khusus untuk tenaga medis (Dokter) agar dapat menginput data riwayat kesehatan, keluhan, diagnosis, dan resep obat pasien setelah sesi konsultasi selesai. Dokter mengisi data melalui form di Frontend, kemudian Backend Laravel akan memproses data tersebut, melakukan sanitasi input (keamanan data), dan menyimpannya ke dalam database MySQL yang saling terelasi dengan data pasien terkait.`

\---

## Fitur 5 — \[Otomatisasi Deployment \& Manajemen Server (CI/CD Kontainer)]

**Role Penanggung Jawab:** `DevOps`

**Sumber Data:** `Internal System`

**Deskripsi \& Ekspektasi:**
`Fitur dari sisi infrastruktur untuk memastikan aplikasi Frontend (HTML/Tailwind) dan Backend (Laravel + MySQL) dapat berjalan secara konsisten dan otomatis. DevOps bertanggung jawab mengonfigurasi Docker Compose agar semua layanan terisolasi dalam kontainer terpisah. Ketika ada pembaruan kode di GitHub, sistem web server Nginx akan dikonfigurasi sebagai reverse proxy untuk mengarahkan lalu lintas data pengguna ke kontainer aplikasi dengan lancar dan aman.`

\---

*(Salin blok di atas untuk fitur selanjutnya)*

