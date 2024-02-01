<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Transaksi  - Big Foody</title>
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
        .tfoot {
            font-weight: bold;
            text-align: left;
        }

    </style>
</head>
<body>
    <h3>Big Foody</h3>
    <h2>Laporan Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Meja</th>
                <th>Tanggal</th>
                <th>Qty</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
        @php
            $counter = 1;
            $totalPemasukan = 0;
        @endphp
            @foreach($transaction as $item)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->id_produk }}</td>
                    <td>{{ $item->meja }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->sub_total }}</td>
                </tr>
                @php
                $totalPemasukan += $item->sub_total; // Add sub_total to totalPemasukan
                @endphp
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" class="tfoot">Total Pemasukan</td>
            <td class="tfoot">{{ $totalPemasukan }}</td>
        </tr>
    </tfoot>
    </table>
    @if(Auth::check())
        <div class="ttd">
            <h4>Subang, {{ now()->format('d F Y') }}</h4><br>
            <h4>{{ Auth::user()->nama }}</h4>
        </div>
    @endif
</body>
</html>
