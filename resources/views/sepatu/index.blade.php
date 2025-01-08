<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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
    <div class="container mt-4">
        <!-- Header -->
        <div class="header-container text-center">
            <h1>Gudang Sepatu</h1>
            <p>Kelola data sepatu dengan mudah dan cepat!</p>
        </div>

        <!-- Tabel Data Sepatu -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Daftar Sepatu</h3>
            </div>
            <div class="card-body">
                @if (isset($sepatu) && !$sepatu->isEmpty())
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sepatu as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <a href="{{ route('sepatu.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('sepatu.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Belum ada data sepatu yang tersedia. Klik tombol <b>Tambah Data Sepatu</b> untuk menambahkan.</p>
                @endif
            </div>
        </div>

        <!-- Tombol Tambah Data -->
        <div class="text-center mt-4">
        <a href="{{ route('sepatu.create') }}" class="btn btn-lg btn-success shadow">+ Tambah Data Sepatu</a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
