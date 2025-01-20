<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn-warning {
            color: white;
        }
        .header-container {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .header-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Daftar Transaksi</h1>
        </div>

        <!-- Tombol Tambah Transaksi -->
        <div class="mt-4">
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Transaksi -->
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Transaksi</th>
                    <th>Nama</th>
                    <th>Jumlah Stok</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>{{ $item->jenis_transaksi }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jumlah_stok }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
