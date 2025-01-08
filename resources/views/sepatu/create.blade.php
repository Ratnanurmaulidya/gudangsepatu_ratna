<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Sepatu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Barang </h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Perbaikan pada definisi route -->
        <form action="{{ route('sepatu.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_sepatu" class="form-label">Nama Barang</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok Barang</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('sepatu.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>
</html>
