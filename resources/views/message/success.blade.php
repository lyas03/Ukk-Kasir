@if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 350px;" role="document">
            <div class="modal-content">
                <div class="modal-body p-0 text-center">
                    <div id="checkIcon">
                        <i class="text-success fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h6 class="mt-2 mb-4 success-heading">Success</h6>
                        <h5>{{ session('success') }}</h5>
                    </div>
                </div>
                <div class="pb-2 pt -1 text-center">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endif