<div class="modal fade" id="produkModal" tabindex="-1" role="dialog" aria-labelledby="produkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produkModalLabel">Pilih Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <input type="hidden" id="id_produk" name="id_produk" value="{{ $product->id_produk }}">
                                    <input type="hidden" id="harga_produk" name="harga_produk" value="{{ $product->harga_produk }}">
                                    {{ $product->nama_produk }}
                                </td>
                                <td>Rp.{{ number_format($product->harga_produk) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="pilihProduk('{{ $product->nama_produk }}', {{ $product->id_produk }}, {{ $product->harga_produk }})">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>