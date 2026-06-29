# Identitas Kelompok

\---

**Nama Kelompok:** `Binary`

**Nama Proyek / Aplikasi:** `Platform Layanan Kesehatan Digital`

**Jumlah Anggota:** `2` orang

#🔐 Akun Demo Pengujian (Untuk Dosen / Asdos)

- **Email:** Admin@gmail.com
- **Password:** 12345678

#Link Akses Aplikasi (Live Website)

- **Link Web:** `https://syahrulkhalik29-source.github.io/platform-layanan-kesehatan-frontend/login.html`

**Repositori:** `https://github.com/syahrulkhalik29-source/platform_layanan_kesehatan_digital`

\---

## Anggota \& Role

**Anggota 1**

- Nama Lengkap: `Farhan wahyudi `
- NIM: `230705040`
- Role: `Frontend Developer`
- Teknologi: `HTML5, Tailwind CSS, Vanilla JavaScript`

**Anggota 2**

- Nama Lengkap: `Syahrul Khalik`
- NIM: `230705081`
- Role: `Backend Developer \\\& DevOps Engineer`
- Teknologi: `Laravel, PHP 8.4, MySQL, Nginx, Docker.`

\---

## Stack Teknologi

**Frontend:** `HTML5, Tailwind CSS, Vanilla JavaScript`

**Backend:** `Laravel` _(wajib)_

**Database:** `MySQL`

**DevOps / Infrastruktur:** `Nginx, Docker, Git, GitHub`

\---

## Arsitektur Aplikasi

_(Jelaskan secara singkat bagaimana aplikasi-aplikasi dalam proyek ini saling terhubung)_

**Aplikasi 1 — Frontend**

- Nama Aplikasi: `Platform Layanan Kesehatan - Client Side`
- Deskripsi Singkat: `Aplikasi web statis (HTML/CSS/JS) yang berfungsi sebagai antarmuka untuk pasien dan dokter. Aplikasi ini bertugas menampilkan visualisasi data, form pendaftaran, dan menerima input dari pengguna.`
- Berkomunikasi dengan: `Aplikasi 3 — Backend (Laravel) menggunakan protokol HTTP (RESTful API / Fetch API).`

**Aplikasi 3 — Backend (Laravel)**

- Nama Aplikasi / Service: `Platform Layanan Kesehatan - API Core`
- Deskripsi Singkat: `Layanan pusat (backend) berbasis Laravel yang mengolah seluruh data dari database MySQL, menjalankan logika bisnis (seperti validasi jadwal dokter), dan menangani keamanan autentikasi.`
- Menyediakan layanan untuk: `Aplikasi 1 — Frontend`
