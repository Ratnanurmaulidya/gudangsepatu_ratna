<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Data Transaksi</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal Transaksi -->
                    <div class="mb-3">
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                               value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" required>
                    </div>

                    <!-- Jenis Transaksi -->
                    <div class="mb-3">
                        <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                        <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                            <option value="">Pilih Jenis Transaksi</option>
                            <option value="Masuk" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Keluar" {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                               placeholder="Masukkan nama barang"
                               value="{{ old('nama', $transaksi->nama) }}" required>
                    </div>

                    <!-- Jumlah Stok -->
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" name="jumlah_stok" id="jumlah_stok" class="form-control"
                               placeholder="Masukkan jumlah stok"
                               value="{{ old('jumlah_stok', $transaksi->jumlah_stok) }}" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                                  placeholder="Masukkan keterangan">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                    </div>

                    <!-- User ID -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="number" name="user_id" id="user_id" class="form-control"
                               placeholder="Masukkan User ID"
                               value="{{ old('user_id', $transaksi->user_id) }}" required>
                    </div>

                    <!-- Tombol Simpan dan Batal -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
