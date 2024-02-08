<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Meja - Big Foody</title>
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
        ul {
            list-style: none;
            padding: 0;
            text-align: left;
        }

        li {
            margin-right: 10px;
        }

    </style>
</head>
<body>
    <h3>Big Foody</h3>
    <h2>Laporan Daftar Meja</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Meja</th>
                <th>Jumlah Kursi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @php
            $counter = 1;
        @endphp
            @foreach($mejas as $item)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $item->no_meja }}</td>
                    <td>{{ $item->jumlah_kursi }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <ul>
        <li>Meja Tersedia: {{ $jumlah_meja_tersedia }}</li>
        <li>Meja Terpakai: {{ $jumlah_meja_terpakai }}</li>
    </ul>
    @if(Auth::check())
        <div class="ttd">
            <h4>Subang, {{ now()->format('d F Y') }}</h4><br>
            <h4>{{ Auth::user()->nama }}</h4>
        </div>
    @endif
</body>
</html>
