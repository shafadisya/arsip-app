@extends('layouts.app')

@section('title', 'Daftar Arsip')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold text-dark">Daftar Arsip</h1>
        <p class="text-muted mb-0">Manajemen dokumen dan file arsip digital HMIF</p>
    </div>
    <div>
        <a href="{{ route('arsips.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Arsip
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                        <i class="fas fa-folder-open text-primary fs-4"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ $arsips->total() }}</h5>
                <p class="text-muted mb-0 small">Total Arsip</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                        <i class="fas fa-calendar-day text-success fs-4"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ $arsips->where('tanggal_upload', '>=', today())->count() }}</h5>
                <p class="text-muted mb-0 small">Hari Ini</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3">
                        <i class="fas fa-user text-info fs-4"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-0 small">{{ auth()->user()->departemen ?? 'Admin' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <i class="fas fa-clock text-warning fs-4"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ now()->format('H:i') }}</h5>
                <p class="text-muted mb-0 small">Waktu Sekarang</p>
            </div>
        </div>
    </div>
</div>

<!-- Filter dan Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('arsips.index') }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="Cari arsip..." value="{{ request('search') }}">
                        <label for="search">
                            <i class="fas fa-search me-2"></i>Cari berdasarkan judul atau deskripsi...
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="kategori" name="kategori">
                            <option value="">Semua Kategori</option>
                            <option value="Surat Undangan" {{ request('kategori') == 'Surat Undangan' ? 'selected' : '' }}>Surat Undangan</option>
                            <option value="Surat Peminjaman" {{ request('kategori') == 'Surat Peminjaman' ? 'selected' : '' }}>Surat Peminjaman</option>
                            <option value="Memo" {{ request('kategori') == 'Memo' ? 'selected' : '' }}>Memo</option>
                            <option value="Laporan" {{ request('kategori') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                            <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <label for="kategori">Kategori</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary h-100 w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Arsip -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-list me-2"></i>Daftar Arsip
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Departemen</th>
                        <th>Pengunggah</th>
                        <th>Tanggal Upload</th>
                        <th>File</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsips as $index => $arsip)
                    <tr>
                        <td>{{ $index + $arsips->firstItem() }}</td>
                        <td>
                            <div class="fw-semibold">{{ $arsip->judul }}</div>
                            <small class="text-muted">{{ Str::limit($arsip->deskripsi, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $arsip->kategori }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $arsip->departemen }}</span>
                        </td>
                        <td>{{ $arsip->pengunggah }}</td>
                        <td>{{ $arsip->tanggal_upload ? $arsip->tanggal_upload->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $arsip->file_path) }}" target="_blank" 
                               class="btn btn-sm btn-outline-info" title="Lihat File">
                                <i class="bi bi-file-earmark-text"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('arsips.show', $arsip) }}" class="btn btn-sm btn-success" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->npm === $arsip->npm_pengunggah)
                                <a href="{{ route('arsips.edit', $arsip) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" title="Hapus" 
                                        onclick="confirmDelete('{{ $arsip->id }}', '{{ $arsip->judul }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-folder-open fs-1 mb-3"></i>
                                <h5>Belum ada arsip</h5>
                                <p>Silakan tambah arsip baru untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($arsips->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $arsips->withQueryString()->links() }}
</div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus arsip:</p>
                <p class="fw-bold" id="deleteTitle"></p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id, title) {
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteForm').action = `/arsips/${id}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush

@endsection