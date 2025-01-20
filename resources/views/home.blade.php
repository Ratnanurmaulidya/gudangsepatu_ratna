<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Gudang Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background-color: #343a40;
            color: white;
            padding: 50px 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
        }
        .features {
            margin-top: 30px;
        }
        .features h3 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Hero Section -->
        <div class="hero">
            <h1>Selamat Datang di Gudang Sepatu</h1>
            <p>Kelola data sepatu dan transaksi dengan mudah, cepat, dan efisien!</p>
        </div>

        <!-- Features Section -->
        <div class="features text-center">
            <h3>Fitur Utama</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Data Sepatu</h5>
                            <p class="card-text">Kelola informasi lengkap tentang sepatu, termasuk stok dan jenisnya.</p>
                            <a href="{{ route('sepatu.index') }}" class="btn btn-primary">Lihat Data Sepatu</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi</h5>
                            <p class="card-text">Catat dan pantau semua transaksi masuk dan keluar sepatu.</p>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Lihat Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5">
            <p>&copy; 2025 Gudang Sepatu. Semua Hak Dilindungi.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
