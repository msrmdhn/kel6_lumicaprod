@extends('layouts.admin')

@section('content')
<div class="mb-3"><a href="{{ route('products.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-arrow-left"></i> Kembali</a></div>

<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark py-3"><h5 class="fw-bold mb-0">Edit Paket Foto</h5></div>
    <div class="card-body p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi / Benefit</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-warning fw-bold">Update Paket</button>
            </div>
        </form>
    </div>
</div>
@endsection