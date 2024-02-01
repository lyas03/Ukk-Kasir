@extends('layout.layout')

@section('title', 'Transaksi')
@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-penjualan tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush
@section('content')
<div class="container">
    <h2 class="h3 mt-4 mb-3">Tambah Transaksi</h2>
    <div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="id_products">Daftar products</label>
                                <select class="form-control" id="id_products">
                                    @foreach ($productsM as $products)
                                        <option value="{{ $products->id_products }}" data-nama="{{ $products->nama }}" data-harga="{{ $products->harga }}" data-id="{{ $products->id_products }}">{{ $products->nama }} - Rp.{{ number_format($products->harga) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" class="btn btn-primary d-block" onclick="tambahItem()">Tambah products</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Quantity</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="transaksiItem">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Jumlah</th>
                                        <th class="quantity">0</th>
                                        <th class="totalHarga">0</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
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
@endsection
@section('js')
<script>
    var totalHarga = 0;
    var quantity = 0;
    var listItem = [];

    function tambahItem(){
        updateTotalHarga(parseInt($('#id_products').find(':selected').data('harga')))
        var item = listItem.filter((el) => el.id_products === $('#id_products').find(':selected').data('id'));
        if(item.length > 0){
            item[0].quantity += 1
        }else{
            var item = {
                id_products: $('#id_products').find(':selected').data('id'),
                nama: $('#id_products').find(':selected').data('nama'),
                harga: $('#id_products').find(':selected').data('harga'),
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
            var quantity = formatRupiah(el.quantity.toString())
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>${el.nama}</td>
                <td>${quantity}</td>
                <td>${harga}</td>
                <td>
                    <input type="hidden" name="id_products[]" value="${el.id_products}">    
                    <input type="hidden" name="quantity[]" value="${el.quantity}"> 
                    <button type="button" onclick="deleteItem(${index})" class="btn btn-link">
                        <i class="fa fa-trash text-danger"></i>    
                    </button>   
                </td>
            </tr>
            `
        })
        $('.transaksiItem').html(html)
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
</script>
@endsection
