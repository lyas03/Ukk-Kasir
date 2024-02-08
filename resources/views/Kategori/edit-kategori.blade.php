<div class="modal fade" id="editKategoriModal{{ $item->id_kategori }}" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalLabel{{ $item->id_kategori }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('kategori.update', ['id_kategori' => $item->id_kategori]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_kategori" value="{{ $item->id_kategori }}">
                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" value="{{ $item->nama_kategori }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Edit Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>
