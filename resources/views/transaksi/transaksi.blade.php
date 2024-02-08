@extends('layout.layout')

@section('title', 'Transaksi')

@section('content')
    <div class="container">
        <h2 class="h3 mt-4 mb-3">Tambah Transaksi</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <form class="form-user" id="transaksiForm" action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="nomor_unik" class="col-lg-2 col-form-label">Nomor Unik</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="nomor_unik" name="nomor_unik" value="{{ $randomNumber }}" readonly>
                                </div>
                                <label for="nama_pelanggan" class="col-lg-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                </div>
                                <!-- <label for="harga_produk" class="col-lg-2 col-form-label">Harga Produk</label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" id="harga_produk" name="harga_produk" readonly>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <label for="pilihan_makan" class="col-lg-2 col-form-label">Pilihan Makan</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="pilihan_makan" name="pilihan_makan" required>
                                            <option value="" disabled selected hidden>Pilih Opsi</option>
                                            <option value="makan_di_tempat">Makan di Tempat</option>
                                            <option value="bawa_pulang">Bawa Pulang</option>
                                        </select>
                                    </div>
                                <label for="no_meja" class="col-lg-2 col-form-label">No Meja</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="no_meja" name="no_meja">
                                            @foreach($meja as $item)
                                                <option value="" disabled selected hidden></option>
                                                <option value="{{ $item->no_meja }}">{{ $item->no_meja }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                <!-- <label for="total_item" class="col-lg-2 col-form-label">Jumlah</label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" id="total_item" name="total_item">
                                </div> -->
                            </div>
                            <div class="form-group row">
                                
                                <label for="total_harga" class="col-lg-2 col-form-label">Total Harga</label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meja" class="col-lg-2 col-form-label">No Meja</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control mr-1" id="meja" name="meja" readonly>
                                            <span class="input-group-btn">
                                                <a class="btn btn-primary" id="tampilMejaBtn" data-toggle="modal" data-target="#modalMeja">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                <label for="uang_bayar" class="col-lg-2 col-form-label">Uang Bayar</label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" id="uang_bayar" name="uang_bayar" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_produk" class="col-lg-2 col-form-label">Nama Produk</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="hidden" id="id_produk" name="id_produk" readonly>
                                        <span id="nama_produk_display" class="form-control mr-1" style="background-color: #e9ecef;" readonly></span>
                                        <span class="input-group-btn">
                                            <a class="btn btn-primary" id="tampilProdukBtn" data-toggle="modal" data-target="#modalProduk">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <label for="uang_kembali" class="col-lg-2 col-form-label">Uang Kembali</label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" id="uang_kembali" name="uang_kembali" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-flat pull-right btn-simpan" id="transaksiBtn">
                                <i class="fa fa-money-bill mr-2"></i> Simpan Transaksi
                            </button>
                        </form>
                    </div>
                        @include('transaksi.produk')
                        @include('transaksi.pilih-meja')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tampilProdukBtn').on('click', function () {
                tampilProduk();
            });
            $('#tampilMejaBtn').on('click', function () {
                tampilMeja();
            });

            $('#modalProduk').on('click', '.pilihProdukBtn', function () {
                pilihProduk($(this));
            });

            $('#modalMeja').on('click', '.pilihMejaBtn', function () {
                pilihMeja($(this));
            });

            function pilihProduk(button) {
                // Mengambil data dari atribut data
                var idProduk = button.data('id');
                var namaProduk = button.data('nama');
                var hargaProduk = button.data('harga');

                // Mengisi nilai ke dalam elemen formulir transaksi
                $('#id_produk').val(idProduk);
                $('#nama_produk_display').text(namaProduk);  // Menampilkan nama produk
                $('#harga_produk').val(hargaProduk);

                // Menutup modal
                hideProduk();
            }

            function hideProduk() {
                $('#modalProduk').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }

            $(document).ready(function () {
                $('#pilihan_makan').on('change', function () {
                    var selectedOption = $(this).val();
                    var noMejaInput = $('#meja');
                    var tampilMejaBtn = $('#tampilMejaBtn');

                    if (selectedOption === 'makan_di_tempat') {
                        noMejaInput.prop('readonly', true);
                        tampilMejaBtn.show(); // Menampilkan tombol saat makan di tempat
                    } else if (selectedOption === 'bawa_pulang') {
                        noMejaInput.val('');
                        noMejaInput.prop('readonly', true);
                        tampilMejaBtn.hide(); // Menyembunyikan tombol saat bawa pulang
                    }
                });
            });

            function tampilProduk() {
                $('#modalProduk').modal('show');
            }
            function tampilMeja() {
                hideMeja();
                $('#modalMeja').modal('show');
            }
            
            function pilihMeja(button) {
                // Mengambil data dari atribut data
                var noMeja = button.data('meja');

                // Mengisi nilai ke dalam elemen formulir transaksi
                $('#meja').val(noMeja);

                // Menutup modal
                hideMeja();
            }

            function hideMeja() {
                $('#modalMeja').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
            $('#total_item').on('input', function () {
                updateTotalHarga();
            });

            function updateTotalHarga() {
                var hargaProduk = parseFloat($('#harga_produk').val()) || 0;
                var totalItem = parseFloat($('#total_item').val()) || 0;

                // Hitung total harga
                var totalHarga = hargaProduk * totalItem;

                // Tampilkan total harga pada input total_harga
                $('#total_harga').val(totalHarga);
            }
            $('#uang_bayar').on('input', function () {
                updateUangKembali();
            });

            function updateUangKembali() {
                var totalHarga = parseFloat($('#total_harga').val()) || 0;
                var uangBayar = parseFloat($('#uang_bayar').val()) || 0;

                // Periksa apakah ada data di total harga
                if (totalHarga > 0) {
                    // Hitung uang kembali
                    var uangKembali = uangBayar - totalHarga;

                    // Tampilkan uang kembali pada input uang_kembali
                    $('#uang_kembali').val(uangKembali);
                } else {
                    // Jika tidak ada data di total harga, kosongkan input uang_kembali
                    $('#uang_kembali').val('');
                }
            }

        });
    </script>
@endsection