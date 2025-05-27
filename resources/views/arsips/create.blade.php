@extends('layouts.app')

@section('title', 'Tambah Arsip')

@section('content')
<h1 class="mb-4">Tambah Arsip Baru</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('arsips.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Arsip</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-select" id="kategori" name="kategori" required onchange="toggleNomorSurat(this.value)">
            <option value="" selected disabled>-- Pilih Kategori --</option>
            @foreach($kategori_options as $kategori)
                <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="nomorSuratDiv" style="display:none;">
        <label for="nomor_surat" class="form-label">Nomor Surat</label>
        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}">
    </div>

    <div class="mb-3">
        <label for="departemen" class="form-label">Departemen</label>
        <select class="form-select" id="departemen" name="departemen" required>
            <option value="" disabled>-- Pilih Departemen --</option>
            @foreach($departemen_options as $dep)
                <option value="{{ $dep }}" {{ old('departemen') == $dep ? 'selected' : '' }}>{{ $dep }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="pengunggah" class="form-label">Nama Pengunggah</label>
        <input type="text" class="form-control" id="pengunggah" name="pengunggah" value="{{ old('pengunggah') }}" required>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Upload File (PDF, JPG, PNG max 2MB)</label>
        <input class="form-control" type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Arsip</button>
    <a href="{{ route('arsips.index') }}" class="btn btn-secondary">Batal</a>
</form>

<script>
function toggleNomorSurat(kategori) {
    const div = document.getElementById('nomorSuratDiv');
    if (kategori === 'Surat Undangan' || kategori === 'Surat Peminjaman') {
        div.style.display = 'block';
        document.getElementById('nomor_surat').required = true;
    } else {
        div.style.display = 'none';
        document.getElementById('nomor_surat').required = false;
        document.getElementById('nomor_surat').value = '';
    }
}

// Init on page load
document.addEventListener('DOMContentLoaded', () => {
    toggleNomorSurat(document.getElementById('kategori').value);
});
</script>
@endsection
