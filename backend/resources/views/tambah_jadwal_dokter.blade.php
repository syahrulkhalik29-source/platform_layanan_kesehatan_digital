<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Booking Jadwal - Platform Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/jadwal-dokter-view">🏥 Platform Layanan Kesehatan Digital</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm border-0">
                    <h4 class="fw-bold text-dark mb-3">Input Booking Jadwal Baru</h4>
                    <p class="text-muted small">Sistem akan otomatis merekomendasikan dokter spesialis yang cocok berdasarkan keluhan pasien di Rekam Medis.</p>
                    <hr>
                    
                    <form action="/jadwal-dokter-simpan" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Pasien</label>
                            <select name="nama_pasien" class="form-select" required>
                                <option value="">-- Pilih Pasien Rekam Medis --</option>
                                @foreach($pilihan_pasien as $pasien)
                                    <option value="{{ $pasien->nama_pasien }}">
                                        {{ $pasien->nama_pasien }} (Keluhan: {{ $pasien->keluhan }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Booking</label>
                            <input type="date" name="tanggal_booking" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jam Booking</label>
                            <input type="time" name="jam_booking" class="form-control" required>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success fw-bold">Simpan Booking & Rekomendasi Dokter</button>
                            <a href="/jadwal-dokter-view" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>