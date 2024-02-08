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
            margin: 0; /* Reset default margin to remove extra space */
        }
        .wrapper {
            max-width: 400px;
            border: 2px solid #000;
            padding: 10px;
            margin: auto; /* Center the wrapper */
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        h2 {
            text-align: center;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="struk-content">
            <h2 class="struk-heading">Struk Transaksi</h2>

            <div>
                <p style="float: left;">Tanggal : {{ date('d-m-Y') }}</p>
                @if(Auth::check())
                <p style="float: right">{{ Auth::user()->nama }}</p>
                @endif
            </div>
            <div class="clear-both" style="clear: both;"></div>
            <p>No Unik : {{ $transaksi->nomor_unik }}</p>
            <p class="text-center">===========================================</p>

            <br>
            <table width="100%" style="border: 0;">
                <tr>
                    <td colspan="3">{{ ($transaksi->id_produk) }}</td>
                </tr>
                <tr>
                    <td>{{ $transaksi->total_item }} x {{ number_format($transaksi->harga_produk) }}</td>
                    <td></td>
                    <td class="text-right">{{ number_format($transaksi->total_harga) }}</td>
                </tr>
            </table>
            <p class="text-center">-----------------------------------</p>

            <table width="100%" style="border: 0;">
                <tr>
                    <td>Total Harga:</td>
                    <td class="text-right">{{ number_format($transaksi->total_harga) }}</td>
                </tr>
                <tr>
                    <td>Total Item:</td>
                    <td class="text-right">{{ number_format($transaksi->total_item) }}</td>
                </tr>
                <tr>
                    <td>Total Bayar:</td>
                    <td class="text-right">{{ number_format($transaksi->uang_bayar) }}</td>
                </tr>
                <tr>
                    <td>Diterima:</td>
                    <td class="text-right">{{ number_format($transaksi->uang_kembali + $transaksi->uang_bayar) }}</td>
                </tr>
                <tr>
                    <td>Kembali:</td>
                    <td class="text-right">{{ number_format($transaksi->uang_kembali) }}</td>
                </tr>
            </table>

            <p class="text-center">===========================================</p>
            <p class="text-center">-- TERIMA KASIH --</p>
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
