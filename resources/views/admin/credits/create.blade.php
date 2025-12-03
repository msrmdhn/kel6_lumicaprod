@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('credits.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Tambah Developer</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('credits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Role (Tugas)</label>
                <input type="text" name="role" class="form-control" placeholder="Contoh: Fullstack Developer" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Github / Portfolio (Opsional)</label>
                <input type="url" name="github_url" class="form-control" placeholder="https://github.com/username">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi / Quotes</label>
                <textarea name="description" class="form-control" rows="2"></textarea>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-dark fw-bold">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection