<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pasien Umum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/rekam-medis-view">🏥 Platform Layanan Kesehatan Digital</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-dark mb-3">Input Rekam Medis Pasien Baru</h4>
                        
                        <form action="/rekam-medis-simpan" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pasien</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap pasien" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Rumah</label>
                                <input type="text" name="nim" class="form-control" placeholder="Contoh: Jl. T. Nyak Arief, Banda Aceh" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Umur (Tahun)</label>
                                <input type="number" class="form-control" placeholder="Contoh: 25" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Keluhan / Sakit yang Dirasakan</label>
                                <textarea name="keluhan" class="form-control" rows="3" placeholder="Contoh: Batuk berdahak dan demam tinggi" required></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold">Simpan Data Pasien</button>
                                <a href="/rekam-medis-view" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>