@if(session('login'))
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 350px;" role="document">
      <div class="modal-content">
        <div class="modal-body p-0 m-3 text-center">
            <div id="checkIcon">
                <i class="text-danger fa-solid fa-circle-xmark"></i>
            </div>
            <div>
                <h6 class="mt-2 mb-4 danger-heading">Failed</h6>
                <h5>{{ session('login') }}</h5>
            </div>
            <div class="pb-2 pt-1 text-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
      </div>
    </div>
  </div>
@endif