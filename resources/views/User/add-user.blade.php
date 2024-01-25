@extends('layout.layout')

@section('title', 'Tambah User')

@section('content')
    <div class="container">
        <h2 class="h3 mt-4 mb-4">Tambah User</h2>
        <form method="post" action="{{ route('store.user') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <div style="display: flex; gap: 10px;">
                    @foreach($roles as $key => $role)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="{{ $role }}" value="{{ $role }}" required>
                            <label class="form-check-label" for="{{ $role }}">
                                {{ ucfirst($role) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary mt-2">Tambah Pengguna</button>
        </form>
    </div>
@endsection
