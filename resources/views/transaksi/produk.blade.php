<div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="modalProdukLabel" aria-hidden="true">
    <div class="modal-dialog" style='max-width:750px;' role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-produk" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga Produk</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <td width="5%">{{ $key+1 }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->harga_produk }}</td>
                                    <td>
                                    <button class="btn btn-primary btn-xs btn-flat pilihProdukBtn"
                                        data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama_produk }}"
                                        data-harga="{{ $item->harga_produk }}">
                                        <i class="fa fa-check-circle"></i> Pilih
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
</div>
