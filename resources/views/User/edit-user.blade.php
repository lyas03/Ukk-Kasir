<div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('users.update', ['id' => $item->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="mb-3">
                            <label for="edit_nama_user" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="edit_nama_user" name="nama" value="{{ $item->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" value="{{ $item->username }}"readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-control" id="edit_role" name="role" required>
                                <option value="" selected disabled></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ $item->role == $role ? 'selected' : ' '}}>
                                        {{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-2">Edit User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>