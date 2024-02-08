<div class="modal fade" id="changePasswordModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Reset Password User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.change', ['id' => $item->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $item->username }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password_new" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="edit_password_new" name="password_new" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password_confirm" class="form-label">Ulangi Password Baru</label>
                            <input type="password" class="form-control" id="edit_password_confirm" name="password_confirm" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-2">Edit User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>