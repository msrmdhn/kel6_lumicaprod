@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Kelola Pengguna (User)</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama User</th>
                    <th>Kontak</th>
                    <th>Role</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $user->name }}</div>
                        <small class="text-muted">{{ $user->username }}</small>
                    </td>
                    <td>
                        <div>{{ $user->email }}</div>
                        <small class="text-muted">{{ $user->no_wa }}</small>
                    </td>
                    <td><span class="badge bg-secondary">Pelanggan</span></td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini? Semua pesanan dia juga akan terhapus!')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada user terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection