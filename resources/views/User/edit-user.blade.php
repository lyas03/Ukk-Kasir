@extends('layout.layout')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <h2 class="h3 mt-4 mb-4">Edit User</h2>
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama User</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <div class="d-flex">
                    @foreach($roles as $role)
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}" {{ $user->role == $role ? 'checked' : '' }} required>
                            <label class="form-check-label" for="role_{{ $role }}" style="text-transform: capitalize;">{{ $role }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-2">Update User</button>
        </form>
    </div>
@endsection
