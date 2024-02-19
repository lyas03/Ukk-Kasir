<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Transaksi - Green Eats</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
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
    <h3>Green Eats</h3>
    <h2>Laporan Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Unik</th>
                <th>Nama Pelanggan</th>
                <th>Pilihan Makan</th>
                <th>Produk</th>
                <th>Sub Total</th>
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
                    <td>{{ $item->nomor_unik }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->pilihan_makan)) }}</td>
                    <td>
                        @foreach($transactions as $transaction)
                            @if($transaction->id_transaction == $item->id)
                                @php
                                    $produk = \App\Models\ProdukM::find($transaction->id_produk);
                                @endphp
                                {{ $produk->nama_produk }} x {{ $transaction->jumlah }},
                            @endif
                        @endforeach
                    </td>
                    <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                </tr>
                @php
                $totalPemasukan += $item->sub_total; // Add sub_total to totalPemasukan
                @endphp
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="tfoot">Total Pemasukan</td>
            <td colspan="2" class="tfoot">{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
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
