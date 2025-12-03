@extends('layouts.app')

@section('title', 'Credit Developer - Lumica Production')

@section('content')
<div class="bg-dark text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold display-5">Credit Developer</h1>
        <p class="lead opacity-75">Dibuat dengan ❤️ oleh Kelompok 6</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4 justify-content-center">
        @forelse($credits as $dev)
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm overflow-hidden h-100 dev-card">
                <div class="row g-0 h-100">
                    
                    <div class="col-4 col-sm-5 bg-light">
                        <img src="{{ asset('storage/' . $dev->image_path) }}" 
                             class="img-fluid w-100 h-100" 
                             style="object-fit: cover; object-position: center; min-height: 200px;" 
                             alt="{{ $dev->name }}">
                    </div>
                    
                    <div class="col-8 col-sm-7 d-flex flex-column">
                        <div class="card-body d-flex flex-column justify-content-center h-100 py-3">
                            <h5 class="fw-bold mb-1 text-dark">{{ $dev->name }}</h5>
                            <small class="text-muted d-block mb-2 font-monospace">{{ $dev->nim }}</small>
                            
                            <div>
                                <span class="badge bg-warning text-dark mb-2 px-3 py-1 rounded-pill">{{ $dev->role }}</span>
                            </div>
                            
                            <p class="card-text small text-muted fst-italic mb-3 border-start border-3 border-warning ps-2">
                                "{{ $dev->description ?? 'No description provided.' }}"
                            </p>
                            
                            @if($dev->github_url)
                            <div class="mt-auto">
                                <a href="{{ $dev->github_url }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    <i class="bi bi-github me-1"></i> Github
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">Data developer belum diisi.</div>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* Sedikit efek hover agar elegan */
    .dev-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dev-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection