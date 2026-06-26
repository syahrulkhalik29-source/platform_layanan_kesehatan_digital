<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Layanan Kesehatan Digital - Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style tambahan agar link panah tidak memiliki garis bawah */
        .btn-return {
            text-decoration: none;
            transition: color 0.2s;
        }
        .btn-return:hover {
            color: #0b5ed7 !important; /* Warna berubah agak gelap saat kursor di atasnya */
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold m-0" href="/dashboard">
                Platform Layanan Kesehatan Digital
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row align-items-start">
            
            <div class="col-auto pt-3 px-3">
                <a href="/dashboard" class="btn-return text-primary fw-bold" style="font-size: 3rem; line-height: 1;">
                    ←
                </a>
            </div>

            <div class="col">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-1 fw-bold text-dark">Data Rekam Medis Pasien</h3>
                        <p class="text-muted mb-4">Halaman pemantauan riwayat kesehatan masyarakat umum.</p>
                        
                        <a href="/rekam-medis-tambah" class="btn btn-success fw-bold mb-3">+ Tambah Rekam Medis Baru</a>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th style="width: 8%">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>Umur</th>
                                        <th>Keluhan / Penyakit</th>
                                        <th>Diagnosis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_medis as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td><strong>{{ $item->nama_pasien }}</strong></td>
                                            <td>{{ $item->nim_atau_id }}</td> 
                                            <td class="text-center">23 Tahun</td> 
                                            <td>{{ $item->keluhan }}</td>
                                            <td><span class="badge bg-info text-dark p-2">{{ $item->diagnosis }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted p-4">
                                                Belum ada data rekam medis pasien di database.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>