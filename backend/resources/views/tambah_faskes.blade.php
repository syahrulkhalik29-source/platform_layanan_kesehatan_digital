<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Tambah Faskes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card p-4">
        <h4 class="fw-bold mb-3">Input Faskes Baru</h4>
        <form action="/faskes-simpan" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-3"><label class="form-label">Nama Fasilitas Kesehatan</label><input type="text" name="nama_faskes" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Jenis Faskes</label><input type="text" name="jenis_faskes" class="form-control" placeholder="Contoh: Klinik Kampus, Apotek, RS" required></div>
            <div class="mb-3"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="2" required></textarea></div>
            <button type="submit" class="btn btn-success w-100 fw-bold">Simpan Faskes</button>
        </form>
    </div></div></div></div>
</body>
</html>