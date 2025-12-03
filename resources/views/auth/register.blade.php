@extends('layouts.app')

@section('title', 'Daftar - Lumica Production')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-warning text-dark text-center py-4">
                    <h4 class="mb-0 fw-bold">DAFTAR AKUN BARU</h4>
                    <small class="opacity-75">Gabung sekarang untuk memesan jasa foto</small>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama sesuai KTP" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Tanpa spasi" required>
                                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">No. WhatsApp</label>
                                <input type="number" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" placeholder="08..." required>
                                @error('no_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter" required>
                            
                            @error('password') 
                                <div class="invalid-feedback fw-bold">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ulangi Password</label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control" 
                                   placeholder="Ketik ulang password di atas" required>
                            <div class="form-text text-muted">Pastikan kedua password sama persis.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-lg fw-bold">DAFTAR SEKARANG</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <small>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-warning">Login disini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection