@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manajemen Credit (Developer)</h3>
    <a href="{{ route('credits.create') }}" class="btn btn-dark">
        <i class="bi bi-code-slash me-1"></i> Tambah Dev
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Nama & NIM</th>
                        <th>Role</th>
                        <th>Links</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($credits as $dev)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $dev->image_path) }}" class="rounded shadow-sm" width="60" height="60" style="object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $dev->name }}</div>
                            <small class="text-muted">{{ $dev->nim }}</small>
                        </td>
                        <td><span class="badge bg-secondary">{{ $dev->role }}</span></td>
                        <td>
                            @if($dev->github_url)
                                <a href="{{ $dev->github_url }}" target="_blank" class="text-dark"><i class="bi bi-github"></i> Github</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('credits.edit', $dev->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('credits.destroy', $dev->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Belum ada data developer.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection