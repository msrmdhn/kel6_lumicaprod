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
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Upload Portofolio Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="title" class="form-control" placeholder="Misal: Wedding Budi & Siti" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Personal">Personal</option>
                            <option value="Group">Group</option>
                            <option value="Couple">Couple</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Foto</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Ceritakan sedikit tentang foto ini..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Simpan & Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection