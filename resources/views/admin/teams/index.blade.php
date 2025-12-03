@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manajemen Tim (About Team)</h3>
    <a href="{{ route('teams.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
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
                        <th>Nama & Role</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $team->image_path) }}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $team->name }}</div>
                            <small class="text-muted">{{ $team->role }}</small>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-instagram me-1"></i> {{ $team->instagram ?? '-' }}</div>
                            <div class="small"><i class="bi bi-whatsapp me-1"></i> {{ $team->phone ?? '-' }}</div>
                        </td>
                        <td>
                            <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-4">Belum ada data tim.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection