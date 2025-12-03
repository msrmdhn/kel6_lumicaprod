@extends('layouts.app')

@section('title', 'Galeri Portofolio - Lumica Production')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Galeri Karya Kami</h2>
        <p class="text-muted">Kumpulan momen terbaik yang telah kami abadikan.</p>
    </div>

    <div class="row g-4">
        @forelse($portfolios as $item)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm overflow-hidden hover-zoom">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <span class="badge bg-warning text-dark mb-2">{{ $item->category }}</span>
                    <h5 class="fw-bold">{{ $item->title }}</h5>
                    <p class="small text-muted">{{ $item->description }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada portofolio yang diupload.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .hover-zoom img { transition: transform 0.3s; }
    .hover-zoom:hover img { transform: scale(1.05); }
</style>
@endsection