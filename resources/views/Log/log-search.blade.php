<div class="modal fade" id="dateSearchModal" tabindex="-1" role="dialog" aria-labelledby="dateSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateSearchModalLabel">Cari Berdasarkan Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('log.search') }}" method="GET">
                    <div class="form-group">
                        <label for="modal_start_date">Tanggal mulai</label>
                        <input type="date" class="form-control" id="modal_start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="modal_end_date">Tanggal selesai</label>
                        <input type="date" class="form-control" id="modal_end_date" name="end_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>