@extends('layout.layout')

@section('title', 'Transaksi')

@section('content')
<div class="container">
    <h2 class="h3 mt-4 mb-3">Tambah Transaksi</h2>
    <form method="post" action="{{ route('store.transaksi') }}" id="myForm">
        @csrf
        <div class="mb-3 w-100">
            <div class="d-flex">
                <div class="mb-2 me-2 flex-grow-1" style="margin-right: 20px;">
                    <label for="nomor_unik" class="form-label">Nomor Unik</label>
                    <input type="text" class="form-control" id="nomor_unik" name="nomor_unik"
                    value="{{ str_pad($nomor_unik, 10, '0', STR_PAD_LEFT) }}" readonly>
                </div>
                <div class="mb-2 flex-grow-1">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="pilihan_makanan" class="form-label me-3">Pilihan Makanan</label>
            <div class="form-check">
                <input class="form-check-input me-2" type="radio" name="pilihan_makanan" id="makan_di_tempat" value="makan_di_tempat" checked>
                <label class="form-check-label" for="makan_di_tempat">Makan di Tempat</label>
            </div>
            <div class="form-check">
                <input class="form-check-input me-2" type="radio" name="pilihan_makanan" id="bawa_pulang" value="bawa_pulang">
                <label class="form-check-label" for="bawa_pulang">Bawa Pulang</label>
            </div>
        </div>

        <div class="mb-3" id="div_nomor_meja">
            <label for="meja" class="form-label">Nomor Meja</label>
            <select class="form-control" id="meja" name="meja" required>
                <option value="" disabled selected>Pilih Nomor Meja</option>
                @foreach($mejas as $meja)
                <option value="{{ $meja->id }}">{{ $meja->no_meja }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 w-100" id="produkContainer">
    <!-- Input Produk -->
        <div class="d-flex">
            <div class="mb-2 me-2 flex-grow-1" style="margin-right: 20px;">
                <label for="id_produk" class="form-label">Nama Produk</label>
                <select class="form-control" id="id_produk" name="id_produk[]">
                    <option value="" disabled selected>Pilih Nama Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-harga="{{ $product->harga_produk }}">{{ $product->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Input Harga Produk -->
            <div class="mb-2 flex-grow-1">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk[]" readonly>
            </div>
        </div>
        <!-- Input Qty dan Total Harga -->
        <div class="d-flex">
            <div class="mb-2 me-5 flex-grow-1" style="margin-right: 20px;">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" class="form-control" id="qty" name="qty[]">
            </div>
            <div class="mb-2 flex-grow-1">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga[]" readonly>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success mt-2 mb-3" id="tambahProduk">Tambah Produk</button>

        <table class="table table-bordered mb-3" id="myTable" width="100%" cellspacing="0">
            <!-- Header Tabel -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody></tbody>
        </table>
        <div class="mb-3">
            <label for="sub_total" class="form-label">Sub Total</label>
            <input type="number" class="form-control" id="sub_total" name="sub_total" readonly>
        </div>
        <div class="mb-3">
            <label for="uang_bayar" class="form-label">Uang Bayar</label>
            <input type="number" class="form-control" id="uang_bayar" name="uang_bayar" required>
        </div>
        <div class="mb-3">
            <label for="uang_kembali" class="form-label">Uang Kembali</label>
            <input type="number" class="form-control" id="uang_kembali" name="uang_kembali" readonly step="1">
        </div>
        <button type="submit" class="btn btn-primary mt-2 mb-3" id="bayarTransaksi">Bayar Transaksi</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen dropdown
        var dropdown = document.getElementById('id_produk');

        // Tambahkan event listener untuk mengupdate harga_produk saat memilih produk
        dropdown.addEventListener('change', function () {
            // Cek apakah opsi yang dipilih tidak kosong
            if (dropdown.value !== "") {
                // Ambil harga dari data-harga attribute pada opsi yang dipilih
                var selectedOption = dropdown.options[dropdown.selectedIndex];
                var hargaProduk = selectedOption.getAttribute('data-harga');

                // Set nilai input harga_produk
                document.getElementById('harga_produk').value = hargaProduk;
            } else {
                // Jika opsi kosong, reset nilai harga_produk
                document.getElementById('harga_produk').value = '';
            }
        });
        
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen qty dan total_harga
        var qtyInput = document.getElementById('qty');
        var totalHargaInput = document.getElementById('total_harga');
        var hargaProdukInput = document.getElementById('harga_produk');

        // Tambahkan event listener untuk mengupdate total harga saat mengisi qty
        qtyInput.addEventListener('input', function () {
            // Ambil nilai qty dan harga_produk
            var qty = parseFloat(qtyInput.value);
            var hargaProduk = parseFloat(hargaProdukInput.value);

            // Cek apakah No Produk sudah dipilih
            if (!isNaN(hargaProduk)) {
                // Hitung total harga
                var totalHarga = qty * hargaProduk;

                // Set nilai input total_harga
                totalHargaInput.value = isNaN(totalHarga) ? '' : totalHarga.toFixed(0);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen uang bayar dan uang kembali
        var uangBayarInput = document.getElementById('uang_bayar');
        var uangKembaliInput = document.getElementById('uang_kembali');
        var totalHargaInput = document.getElementById('total_harga');

        // Tambahkan event listener untuk mengupdate uang kembali saat mengisi uang bayar
        uangBayarInput.addEventListener('input', function () {
            // Ambil nilai uang bayar dan subtotal
            var uangBayar = parseFloat(uangBayarInput.value);
            var subtotal = parseFloat(document.getElementById('sub_total').value);

            // Cek apakah subtotal dan uang bayar adalah angka yang valid
            if (!isNaN(subtotal) && !isNaN(uangBayar)) {
                // Hitung uang kembali
                var uangKembali = uangBayar - subtotal;

                // Set nilai input uang kembali
                document.getElementById('uang_kembali').value = isNaN(uangKembali) ? '' : uangKembali.toFixed(0);
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen radio button dan input nomor meja
        var makanDiTempatRadio = document.getElementById('makan_di_tempat');
        var bawaPulangRadio = document.getElementById('bawa_pulang');
        var divNomorMeja = document.getElementById('div_nomor_meja');
        var nomorMejaSelect = document.getElementById('meja');

        // Tambahkan event listener untuk memantau perubahan pada radio button
        makanDiTempatRadio.addEventListener('change', function () {
            if (makanDiTempatRadio.checked) {
                // Jika memilih makan di tempat, tampilkan input nomor meja
                divNomorMeja.style.display = 'block';
            }
        });

        bawaPulangRadio.addEventListener('change', function () {
            if (bawaPulangRadio.checked) {
                // Jika memilih bawa pulang, sembunyikan input nomor meja
                divNomorMeja.style.display = 'none';
                // Reset nilai pada input nomor meja
                nomorMejaSelect.value = '';
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    var counter = 1;

    var tambahProdukBtn = document.getElementById('tambahProduk');
    tambahProdukBtn.addEventListener('click', function () {
        tambahProduk(counter++);
    });

    function tambahProduk(counter) {
        var tableBody = document.querySelector('#myTable tbody');

        var idProduk = document.getElementById('id_produk').value;
        var qty = document.getElementById('qty').value;

        // Validasi: Periksa apakah data kosong
        if (idProduk === '' || qty === '') {
            alert('Harap lengkapi data produk sebelum menambahkannya.');
            return;
        }

        var namaProduk = document.getElementById('id_produk').options[document.getElementById('id_produk').selectedIndex].text;
        var hargaProduk = document.getElementById('harga_produk').value;
        var totalHarga = document.getElementById('total_harga').value;

        var existingRow = cariProdukDiTabel(idProduk);

        if (existingRow) {
            var existingQty = parseFloat(existingRow.cells[3].textContent);
            var existingTotalHarga = parseFloat(existingRow.cells[4].textContent);

            existingRow.cells[3].textContent = existingQty + parseFloat(qty);
            existingRow.cells[4].textContent = existingTotalHarga + parseFloat(totalHarga);
        } else {
            var newRow = tableBody.insertRow();
            newRow.innerHTML = '<td>' + counter + '</td>' +
                '<td>' + namaProduk + '</td>' +
                '<td>' + hargaProduk + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + totalHarga + '</td>' +
                '<td><button type="button" class="btn btn-danger hapusProdukBtn">Hapus</button></td>';

            document.getElementById('id_produk').value = '';
            document.getElementById('harga_produk').value = '';
            document.getElementById('qty').value = '';
            document.getElementById('total_harga').value = '';

            newRow.querySelector('.hapusProdukBtn').addEventListener('click', function () {
                tableBody.removeChild(newRow);
                counter = setUlangID(counter);
                hitungSubTotal();
            });

            hitungSubTotal();
        }
    }

    function cariProdukDiTabel(idProduk) {
        var tableBody = document.querySelector('#myTable tbody');

        for (var i = 0; i < tableBody.rows.length; i++) {
            var rowIdProduk = tableBody.rows[i].cells[1].textContent;

            if (rowIdProduk == idProduk) {
                return tableBody.rows[i];
            }
        }

        return null;
    }

    function setUlangID(counter) {
        var tableBody = document.querySelector('#myTable tbody');

        for (var i = 0; i < tableBody.rows.length; i++) {
            tableBody.rows[i].cells[0].innerHTML = counter++;
        }

        return counter;
    }

    function hitungSubTotal() {
        var subtotal = 0;

        var totalHargaElements = document.querySelectorAll('#myTable tbody td:nth-child(5)');

        totalHargaElements.forEach(function (element) {
            var harga = parseFloat(element.textContent);
            if (!isNaN(harga)) {
                subtotal += harga;
            }
        });

        document.getElementById('sub_total').value = subtotal;
    }

    var bayarTransaksiBtn = document.getElementById('bayarTransaksi');
    bayarTransaksiBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission

        document.getElementById('myForm').submit();
    });
});

</script>

@endsection
