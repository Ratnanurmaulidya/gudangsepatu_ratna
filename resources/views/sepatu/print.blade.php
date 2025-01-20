<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Sepatu</h1>
        <table class="table table-bordered">
            <tr>
                <th>Nama Sepatu</th>
                <td>{{ $sepatu->nama }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $sepatu->stok }}</td>
            </tr>
        </table>
        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
            <a href="{{ route('sepatu.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>
