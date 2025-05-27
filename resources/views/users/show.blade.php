@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="card p-4 mx-auto" style="max-width: 500px;">
    <h4 class="mb-4 fw-bold">Detail Pengguna</h4>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>NPM:</strong> {{ $user->npm }}</li>
        <li class="list-group-item"><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
        <li class="list-group-item"><strong>Departemen:</strong> {{ $user->departemen }}</li>
    </ul>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection