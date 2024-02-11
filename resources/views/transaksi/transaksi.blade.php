@extends('layout.layout')

@section('title', 'Transaksi')

@section('content')
    <div class="container">
        <h2 class="h3 mt-4 mb-3">Tambah Transaksi</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <form class="form-user" action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="nomor_unik" class="col-lg-2 col-form-label">Nomor Unik</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="nomor_unik" name="nomor_unik" value="{{ $randomNumber }}" readonly>
                                </div>
                                <label for="pilihan_makan" class="col-lg-2 col-form-label">Pilihan Makan</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="pilihan_makan" name="pilihan_makan" required>
                                            <option value="" disabled selected hidden>Pilih Opsi</option>
                                            <option value="makan_di_tempat">Makan di Tempat</option>
                                            <option value="bawa_pulang">Bawa Pulang</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_pelanggan" class="col-lg-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                </div>
                                <label for="meja" class="col-lg-2 col-form-label">No Meja</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="meja" name="meja">
                                            @foreach($meja as $item)
                                                <option value="" disabled selected hidden></option>
                                                <option value="{{ $item->no_meja }}">{{ $item->no_meja }} - {{ $item->jumlah_kursi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="id_produk" class="col-lg-2 col-form-label">Nama Produk</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="id_produk">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id_produk }}" data-nama="{{ $product->nama_produk }}" data-harga="{{ $product->harga_produk }}" data-id="{{ $product->id_produk }}">{{ $product->nama_produk }} - Rp.{{ number_format($product->harga_produk) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary d-block" onclick="tambahItem()">Tambah Produk</button>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th style="width: 200px">Nama</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="transaksiItem" style="text-align: left;">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Jumlah</th>
                                                    <th class="quantity" style="width:150px;">0</th>
                                                    <th class="totalHarga">0</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <label for="uang_bayar" class="col-lg-2 col-form-label">Uang Bayar</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="uang_bayar" name="uang_bayar" oninput="hitungUangKembali()" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <label for="uang_kembali" class="col-lg-2 col-form-label">Uang Kembali</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="uang_kembali" name="uang_kembali" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="total_harga" value="0">
                                        <button class="btn btn-primary">Simpan Transaksi</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    var totalHarga = 0;
    var quantity = 0;
    var listItem = [];
    
    function tambahItem(){
        updateTotalHarga(parseInt($('#id_produk').find(':selected').data('harga')));
        var item = listItem.filter((el) => el.id_produk === $('#id_produk').find(':selected').data('id'));
        if(item.length > 0){
            item[0].quantity += 1
        }else{
            var item = {
                id_produk: $('#id_produk').find(':selected').data('id'),
                nama: $('#id_produk').find(':selected').data('nama'),
                harga: $('#id_produk').find(':selected').data('harga'),
                quantity: 1
            }
            listItem.push(item)
        }
        updateQuantity(1)
        updateTable()
    }

    function updateTable(){
        var html = '';
        listItem.map((el,index) => {
            var harga = formatRupiah(el.harga.toString())
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>${el.nama}</td>
                <td><input type="number" name="quantity[]" class="form-control" value="${el.quantity}" onchange="updateItemQuantity(${index}, this.value)" min="1"></td>
                <td>${harga}</td>
                <td>
                    <input type="hidden" name="id_produk[]" value="${el.id_produk}">
                    <button type="button" onclick="deleteItem(${index})" class="btn btn-link">
                        <i class="fa fa-trash text-danger"></i>    
                    </button>   
                </td>
            </tr>
            `
        })
        $('.transaksiItem').html(html)
    }
    function updateItemQuantity(index, newQuantity){
        var item = listItem[index];
        var diffQuantity = newQuantity - item.quantity;
        
        updateTotalHarga(diffQuantity * item.harga);
        updateQuantity(diffQuantity);
        
        listItem[index].quantity = parseInt(newQuantity);
    }
    function deleteItem(index){
        var item = listItem[index]
        if(item.quantity > 1){
            listItem[index].quantity -= 1;
            updateTotalHarga(-(item.harga))
            updateQuantity(-1)
        }else{
            listItem.splice(index,1)
            updateTotalHarga(-(item.harga * item.quantity))
            updateQuantity(-(item.quantity))
        }
        updateTable()
    }

    function updateTotalHarga(nom){
        totalHarga += nom;
        $('[name=total_harga]').val(totalHarga)
        $('.totalHarga').html(formatRupiah(totalHarga.toString()))
    }

    function updateQuantity(nom){
        quantity += nom;
        $('.quantity').html(formatRupiah(quantity.toString()))
    }

    function hitungUangKembali() {
        var uangBayar = parseFloat($('#uang_bayar').val()) || 0;
        var totalHarga = parseFloat($('[name=total_harga]').val()) || 0;

        var uangKembali = uangBayar - totalHarga;
        $('#uang_kembali').val(uangKembali);
    }
    function hideShowMejaDropdown() {
        var pilihanMakan = document.getElementById('pilihan_makan');
        var mejaInput = document.getElementById('meja');

        // Check the selected option and modify the attributes accordingly
        if (pilihanMakan.value === 'bawa_pulang') {
            mejaInput.disabled = true;
            mejaInput.value = ''; // Reset the value when 'bawa_pulang' is selected
        } else {
            mejaInput.disabled = false;
        }
    }

    // Panggil fungsi hideShowMejaDropdown saat terjadi perubahan pada pilihan_makan
    document.getElementById('pilihan_makan').addEventListener('change', hideShowMejaDropdown);
</script>
@endsection
