@extends('layouts.app')

@section('title', 'Home - Lumica Production')

@section('content')
<section class="bg-light py-5">
    <div class="container py-5">
        <div class="row align-items-center flex-md-row-reverse">
            <div class="col-lg-6 text-center mb-4 mb-lg-0">
                <img src="https://placehold.co/600x400/212529/FFF?text=Lumica+Photography" alt="Hero Image" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover;">
            </div>
            
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">Abadikan Momen <span class="text-warning">Terbaikmu</span></h1>
                <p class="lead text-secondary mb-4">
                    Lumica Production Adalah agensi kreatif bergerak dalam bidang Fotografi & Videografi. Diisi oleh Orang-orang professional dalam bekerja dan merealisasikan ide dan Konsep Client.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('orders.create') }}" class="btn btn-dark btn-lg px-4 shadow">
                        <i class="bi bi-camera-fill me-2"></i> Pesan Sekarang
                    </a>
                    <a href="{{ route('public.portfolio') }}" class="btn btn-outline-dark btn-lg px-4">
                        Lihat Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-2">SERVICES</span>
            <h2 class="fw-bold">Layanan Kami</h2>
            <p class="text-muted">Pilih paket foto sesuai kebutuhan Anda</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box bg-light text-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-bounding-box fs-1"></i>
                        </div>
                        <h4>Personal Shoot</h4>
                        <p class="text-muted">Tampil percaya diri dengan sesi foto individu untuk branding atau wisuda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box bg-light text-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>
                        <h4>Group Photos</h4>
                        <p class="text-muted">Abadikan kebersamaan seru bareng circle pertemanan atau keluarga besar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box bg-light text-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-heart-fill fs-1"></i>
                        </div>
                        <h4>Couple Session</h4>
                        <p class="text-muted">Ciptakan memori romantis dan estetik bersama pasangan tercinta.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <span class="badge bg-dark px-3 py-2 rounded-pill mb-2">LATEST WORK</span>
                <h2 class="fw-bold mb-0">Portofolio Terbaru</h2>
            </div>
            <a href="{{ route('public.portfolio') }}" class="btn btn-link text-dark text-decoration-none fw-bold">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($latestPortfolios as $item)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 250px; object-fit: cover;">
                        
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">{{ $item->category }}</span>
                            <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($item->description, 60) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fst-italic">Belum ada portofolio yang ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4">
        <h2 class="fw-bold mb-3">Siap Mengabadikan Momenmu?</h2>
        <p class="lead opacity-75 mb-4">Jangan biarkan momen spesial berlalu begitu saja. Booking jadwalmu sekarang!</p>
        <a href="{{ route('orders.create') }}" class="btn btn-warning btn-lg fw-bold px-5 rounded-pill shadow">
            Booking Sekarang
        </a>
    </div>
</section>

<style>
    /* Efek Hover Card biar interaktif */
    .hover-up { transition: transform 0.3s; }
    .hover-up:hover { transform: translateY(-5px); }
</style>
@endsection