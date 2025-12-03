@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manajemen Portofolio</h3>
    <a href="{{ route('portfolios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Judul & Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                 alt="Thumbnail" 
                                 class="rounded" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $item->title }}</div>
                            <span class="badge bg-info text-dark">{{ $item->category }}</span>
                        </td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('portfolios.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('portfolios.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-images fs-1 d-block mb-2"></i>
                            Belum ada data portofolio.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection