@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="card p-4 mx-auto" style="max-width: 500px;">
    <h4 class="mb-4 fw-bold">Tambah Pengguna</h4>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" name="npm" class="form-control" required value="{{ old('npm') }}">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="departemen" class="form-label">Departemen</label>
            <select name="departemen" class="form-select" required>
                <option value="">Pilih Departemen</option>
                @foreach(['DPH','MBA', 'PPM', 'PKM', 'ADM', 'KEAGAMAAN', 'HUAL', 'SOSMAS', 'KOMINKRAF'] as $dep)
                    <option value="{{ $dep }}" {{ old('departemen') == $dep ? 'selected' : '' }}>{{ $dep }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection