@extends('layouts.admin')

@section('content')
<div class="mb-3">
    <a href="{{ route('portfolios.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="fw-bold mb-0">Edit Portofolio</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="Personal" {{ $portfolio->category == 'Personal' ? 'selected' : '' }}>Personal</option>
                            <option value="Group" {{ $portfolio->category == 'Group' ? 'selected' : '' }}>Group</option>
                            <option value="Couple" {{ $portfolio->category == 'Couple' ? 'selected' : '' }}>Couple</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto (Opsional)</label>
                        <br>
                        <img src="{{ asset('storage/' . $portfolio->image_path) }}" width="100" class="rounded mb-2 border">
                        
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $portfolio->description) }}</textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Update Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection