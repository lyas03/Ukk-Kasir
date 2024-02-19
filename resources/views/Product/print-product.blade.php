<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Produk - Green Eats</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: #000;
        }

        h2 {
            color: #000;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #a9a9a9;
            text-align: center;
        }

        .ttd {
            margin-top: 30px;
            text-align: right;
        }
        .ttd h4 {
            font-weight: normal;
        }

    </style>
</head>
<body>
    <h3>Green Eats</h3>
    <h2>Laporan Daftar Product</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Produk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @php
            $counter = 1;
        @endphp
            @foreach($product as $produk)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->kategori }}</td>
                    <td>{{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                    <td>{{ $produk->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(Auth::check())
        <div class="ttd">
            <h4>Subang, {{ now()->format('d F Y') }}</h4><br>
            <h4>{{ Auth::user()->nama }}</h4>
        </div>
    @endif
</body>
</html>
