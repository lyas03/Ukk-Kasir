<div class="modal fade" id="editMejaModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editMejaModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMejaModalLabel">Edit Meja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('meja.update', ['id' => $item->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="mb-3">
                        <label for="edit_no_meja" class="form-label">No Meja</label>
                        <input type="text" class="form-control" id="edit_no_meja" name="no_meja" value="{{ $item->no_meja }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jumlah_kursi" class="form-label">Jumlah Kursi</label>
                        <input type="text" class="form-control" id="edit_jumlah_kursi" name="jumlah_kursi" value="{{ $item->jumlah_kursi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Tersedia" {{ $item->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Terpakai" {{ $item->status == 'Terpakai' ? 'selected' : '' }}>Terpakai</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2">Update Meja</button>
                </form>
            </div>
        </div>
    </div>
</div>
