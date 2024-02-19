<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        body {
            margin: 0;
        }
        .wrapper {
            max-width: 100%;
            top: 0;
        }
        p {
            display: block;
            font-size: 7pt;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            font-size: 7pt;
        }

        .text-center {
            font-size: 7pt;
            text-align: center;
            margin: 0;
        }
        h3 {
            text-align: center;
            font-size: 13pt;
            margin: 0;
        }
        .data {
            margin-top: 6;
        }
        .text-right {
            text-align: right;
        }
        .total {
            margin: 3px;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="struk-content">
                <h3>Green Eats</h3>
                
            <p class="text-center">============================</p>
            <div class="data">
                <p>No Unik : {{ $transaksiData->nomor_unik }}</p>
                <p style="float: left;">Tanggal : {{ date('d-m-Y') }}</p>
                <p style="float: right;">{{ date('H:i:s') }}</p>
            </div>
            <p class="text-center">============================</p>
            <p>Nama Pelanggan : {{ $transaksiData->nama_pelanggan }}</p>
            <p>Type : {{ ucwords(str_replace('_', ' ', $transaksiData->pilihan_makan)) }}</p>
            <p>No.Meja : {{ $transaksiData->meja }}</p>
            @if(Auth::check())
                <p>Kasir : {{ Auth::user()->nama }}</p>
            @endif
            <p class="text-center">============================</p>

            <table width="100%" style="border: 0;">
                @foreach($transaksiData->detailTransaksis as $detailTransaksi)
                    @php
                        $produk = $detailTransaksi->produk;
                    @endphp
                    <tr>
                        <td colspan="3">{{ $produk->nama_produk }}</td>
                    </tr>
                    <tr>
                        <td>{{ $detailTransaksi->jumlah }} x {{ number_format($produk->harga_produk) }}</td>
                        <td></td>
                        <td class="text-right">{{ number_format($detailTransaksi->jumlah * $produk->harga_produk) }}</td>
                    </tr>
                @endforeach
            </table>
            <p class="text-center">------------------------------------------------</p>

            <table class="total" width="100%" style="border: 0;">
                <tr>
                    <td class="text-right">Sub Harga:</td>
                    <td class="text-right">{{ number_format($transaksiData->sub_total) }}</td>
                </tr>
                <tr>
                    <td class="text-right">Uang Bayar:</td>
                    <td class="text-right">{{ number_format($transaksiData->uang_bayar) }}</td>
                </tr>
                <tr>
                    <td class="text-right">Uang Kembali:</td>
                    <td class="text-right">{{ number_format($transaksiData->uang_kembali) }}</td>
                </tr>
            </table>

            <p class="text-center">============================</p>
            <p class="text-center">-- Transaksi Berhasil --</p>
            <p class="text-center">Rawalele, Dawuan, Subang</p>
        </div>
    </div>

    <script>
        // Automatically trigger the print dialog when the page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
