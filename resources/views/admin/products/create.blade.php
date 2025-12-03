@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('products.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3"><h5 class="fw-bold mb-0">Tambah Paket Baru</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Pre-Wedding Outdoor" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="price" class="form-control" placeholder="0" min="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi / Benefit</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan apa saja yang didapat klien..." required></textarea>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary fw-bold">Simpan Paket</button>
            </div>
        </form>
    </div>
</div>
@endsection