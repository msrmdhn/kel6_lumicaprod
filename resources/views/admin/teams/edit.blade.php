@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('teams.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark py-3"><h5 class="fw-bold mb-0">Edit Anggota Tim</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jabatan (Role)</label>
                <input type="text" name="role" class="form-control" value="{{ $team->role }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto (Opsional)</label><br>
                <img src="{{ asset('storage/' . $team->image_path) }}" width="80" class="rounded-circle mb-2 border">
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <h6 class="mt-4 mb-3 text-muted">Kontak</h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Username IG</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="instagram" class="form-control" value="{{ $team->instagram }}">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $team->email }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="number" name="phone" class="form-control" value="{{ $team->phone }}">
                </div>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-warning fw-bold">Update Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection