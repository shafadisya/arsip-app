@extends('layouts.app')

@section('content')
<h1>Detail Arsip</h1>

<p><strong>Judul:</strong> {{ $arsip->judul }}</p>
<p><strong>Deskripsi:</strong> {{ $arsip->deskripsi }}</p>
<p><strong>Kategori:</strong> {{ $arsip->kategori }}</p>
<p><strong>Nomor Surat:</strong> {{ $arsip->nomor_surat ?? '-' }}</p>
<p><strong>Departemen:</strong> {{ $arsip->departemen }}</p>
<p><strong>Pengunggah:</strong> {{ $arsip->pengunggah }}</p>
<p><strong>File:</strong> <a href="{{ asset('storage/' . $arsip->file_path) }}" target="_blank">Lihat File</a></p>

<a href="{{ route('arsips.index') }}">Kembali ke Daftar Arsip</a>

@endsection
