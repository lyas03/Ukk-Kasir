<div class="modal fade" id="tambahMejaModal" tabindex="-1" role="dialog" aria-labelledby="tambahMejakModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMejaModalLabel">Tambah Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('store.meja') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="no_meja" class="form-label">No Meja</label>
                            <input type="nomber" class="form-control" id="no_meja" name="no_meja" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                            <input type="nomber" class="form-control" id="jumlah_kursi" name="jumlah_kursi" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-2">Tambah Meja</button>
                    </form>
                </div>
            </div>
        </div>
    </div>