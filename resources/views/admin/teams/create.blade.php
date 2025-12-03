@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('teams.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Tambah Anggota Tim</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jabatan (Role)</label>
                <input type="text" name="role" class="form-control" placeholder="Misal: Lead Photographer" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>

            <h6 class="mt-4 mb-3 text-muted">Kontak (Opsional)</h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Username IG</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="instagram" class="form-control" placeholder="lumica.pro">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="number" name="phone" class="form-control" placeholder="+628xx">
                </div>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary fw-bold">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection