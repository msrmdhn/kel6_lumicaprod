@extends('layouts.app')

@section('title', 'Tim Kami - Lumica Project')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Meet Our Team</h2>
        <p class="text-muted">Orang-orang kreatif di balik lensa Lumica.</p>
    </div>

    <div class="row justify-content-center g-4">
        @forelse($teams as $team)
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow text-center h-100 py-4">
                <div class="card-body">
                    <img src="{{ asset('storage/' . $team->image_path) }}" class="rounded-circle mb-3 shadow-sm border border-3 border-white" width="120" height="120" style="object-fit: cover;">
                    <h5 class="fw-bold mb-1">{{ $team->name }}</h5>
                    <p class="text-warning fw-bold small">{{ $team->role }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        @if($team->instagram)
                        <a href="https://instagram.com/{{ str_replace('@', '', $team->instagram) }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-circle"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($team->phone)
                        <a href="https://wa.me/{{ $team->phone }}" target="_blank" class="btn btn-outline-success btn-sm rounded-circle"><i class="bi bi-whatsapp"></i></a>
                        @endif
                        @if($team->email)
                        <a href="mailto:{{ $team->email }}" class="btn btn-outline-danger btn-sm rounded-circle"><i class="bi bi-envelope"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">Data tim belum diisi.</div>
        @endforelse
    </div>
</div>
@endsection