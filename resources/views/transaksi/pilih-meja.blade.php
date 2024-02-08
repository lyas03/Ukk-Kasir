<div class="modal fade" id="modalMeja" tabindex="-1" aria-labelledby="modalMejaLabel" aria-hidden="true">
    <div class="modal-dialog" style='max-width:750px;' role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMejaModalLabel">Tambah Meja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-meja" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Meja</th>
                            <th>Jumlah Kursi</th>
                            <th>Status</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($meja as $key => $item)
                                <tr>
                                    <td width="5%">{{ $key+1 }}</td>
                                    <td>{{ $item->no_meja }}</td>
                                    <td>{{ $item->jumlah_kursi }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @if($item->status === 'Tersedia')
                                            <button class="btn btn-primary btn-xs btn-flat pilihMejaBtn"
                                                data-id="{{ $item->id }}"
                                                data-meja="{{ $item->no_meja }}">
                                                <i class="fa fa-check-circle"></i> Pilih
                                            </button>
                                        @else
                                            <!-- Tombol non-aktif untuk kursi yang tidak tersedia -->
                                            <button class="btn btn-xs btn-secondary" disabled>
                                                <i class="fa fa-times-circle"></i> Tidak Tersedia
                                            </button>
                                        @endif
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
