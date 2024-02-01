
<div class="modal fade" id="editProdukModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editProdukModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{ route('product.update', ['id' => $item->id]) }}">
                    @csrf
                    @method('PUT')
                    <!-- Tambahkan input hidden untuk menyimpan ID produk -->
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="mb-3">
                        <label for="edit_nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" value="{{ $item->nama_produk }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_id_kategori" class="form-label">Kategori</label>
                        <select class="form-control" id="edit_id_kategori" name="id_kategori" required>
                            <option value="" selected disabled></option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ $item->kategori->nama_kategori == $kategori ? 'selected' : '' }}>
                                    {{ ucfirst($kategori) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga_produk" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" id="edit_harga_produk" name="harga_produk" value="{{ $item->harga_produk }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="edit_stok" name="stok" value="{{ $item->stok }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Edit Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>
