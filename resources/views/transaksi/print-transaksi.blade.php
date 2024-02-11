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
                <th>Produk</th>
                <th>Total Harga</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Tanggal</th>
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
                    <td>
                        @php
                            $totalHarga = 0;
                        @endphp
                        @foreach($transactions as $transaction)
                            @if($transaction->id_transaction == $item->id)
                                @php
                                    $produk = \App\Models\ProdukM::find($transaction->id_produk);
                                @endphp
                                   - {{ $produk->nama_produk }} Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }} x {{ $transaction->jumlah }}<br>
                                @php
                                    $totalHarga = $transaction->total_harga;
                                @endphp
                            @endif
                        @endforeach
                    </td>
                    <td>{{ number_format($totalHarga, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->uang_bayar, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->uang_kembali, 0, ',', '.') }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @php
                $totalPemasukan += $totalHarga; // Add sub_total to totalPemasukan
                @endphp
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="tfoot">Total Pemasukan</td>
            <td colspan="4" class="tfoot">{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
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
