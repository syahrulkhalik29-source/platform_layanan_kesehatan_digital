<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep Obat - Platform Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/resep-obat-view">🏥 Platform Layanan Kesehatan Digital</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm border-0">
                    <h4 class="fw-bold text-dark mb-3">Input Resep Obat Baru</h4>
                    <p class="text-muted small">Sistem akan otomatis menentukan jenis obat, aturan pakai, dan estimasi harga yang sesuai dengan keluhan pasien.</p>
                    <hr>
                    
                    <form action="/resep-obat-simpan" method="POST">
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
                            <label class="form-label fw-bold">Jumlah Obat yang Diperlukan</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 10" min="1" required>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success fw-bold">Simpan & Racik Obat Otomatis</button>
                            <a href="/resep-obat-view" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>