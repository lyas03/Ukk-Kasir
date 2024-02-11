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
            position: absolute;
            top: 0;
        }
        p {
            display: block;
            font-size: 7pt;
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
        }
        h2 {
            text-align: center;
            font-size: 20pt;
            margin-top: 0;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="struk-content">
            <h2>Big Food</h2>
            <p class="text-center">======================================</p>
            <p>Tanggal : {{ date('d-m-Y') }}</p>
            <p>Jam : {{ date('H:i:s') }}</p>
            <p>No Unik : {{ $transaksiData->nomor_unik }}</p>
            <p>Nama Pelanggan : {{ $transaksiData->nama_pelanggan }}</p>
            <p>No.Meja : {{ $transaksiData->meja }}</p>
            @if(Auth::check())
                <p>Kasir : {{ Auth::user()->nama }}</p>
            @endif
            <p class="text-center">======================================</p>

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
            <p class="text-center">-------------------------------------------------------------------</p>

            <table width="100%" style="border: 0;">
                <tr>
                    <td class="text-right">Total Harga:</td>
                    <td class="text-right">{{ number_format($detailTransaksi->total_harga) }}</td>
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

            <p class="text-center">======================================</p>
            <p class="text-center">-- TERIMA KASIH ATAS KUNJUNGAN ANDA --</p>
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
