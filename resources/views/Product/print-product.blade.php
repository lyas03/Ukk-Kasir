<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Produk - Big Foody</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: #333;
        }

        h2 {
            color: #444;
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
            background-color: #f2f2f2;
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
    <h3>Big Foody</h3>
    <h2>Laporan Daftar Product</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Produk</th>
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
                    <td>
                        @if($produk->kategori === 'makanan')
                        Makanan
                        @elseif($produk->kategori === 'minuman')
                        Minuman
                        @endif
                    </td>
                    <td>{{ $produk->harga_produk }}</td>
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
