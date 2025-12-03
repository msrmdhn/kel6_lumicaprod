@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('credits.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark py-3"><h5 class="fw-bold mb-0">Edit Developer</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('credits.update', $credit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $credit->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ $credit->nim }}" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Role (Tugas)</label>
                <input type="text" name="role" class="form-control" value="{{ $credit->role }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto</label><br>
                <img src="{{ asset('storage/' . $credit->image_path) }}" width="60" class="rounded mb-2 border">
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Link Github / Portfolio</label>
                <input type="url" name="github_url" class="form-control" value="{{ $credit->github_url }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi / Quotes</label>
                <textarea name="description" class="form-control" rows="2">{{ $credit->description }}</textarea>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-warning fw-bold">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection