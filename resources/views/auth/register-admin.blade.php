@extends('layouts.app')

@section('title', 'Admin Registration - Restricted Area')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-danger text-white p-4 text-center position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10" style="background: repeating-linear-gradient(45deg, transparent, transparent 10px, #000 10px, #000 20px);"></div>
                    
                    <div class="position-relative z-1">
                        <h3 class="fw-bold mb-0">RESTRICTED ACCESS</h3>
                        <small class="text-white-50 text-uppercase letter-spacing-2">Pendaftaran Administrator Lumica</small>
                    </div>
                </div>

                <div class="card-body p-5 bg-white">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Akses Ditolak!</strong><br>
                                Data yang Anda masukkan tidak valid atau kode rahasia salah.
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('register.admin.process') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4 bg-light p-3 rounded border border-danger border-opacity-25">
                            <label class="form-label fw-bold text-danger small text-uppercase">
                                <i class="bi bi-key-fill me-1"></i> Kode Akses Rahasia
                            </label>
                            <input type="password" name="secret_key" 
                                   class="form-control form-control-lg border-danger @error('secret_key') is-invalid @enderror" 
                                   placeholder="Masukkan kode tim..." required>
                            @error('secret_key')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @else
                                <div class="form-text text-danger small">*Hanya untuk internal tim Lumica.</div>
                            @enderror
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-badge me-2"></i>Identitas Admin</h6>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Nama Admin" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Username</label>
                                <input type="text" name="username" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       value="{{ old('username') }}" placeholder="admin_lumica" required>
                                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">No. WhatsApp</label>
                                <input type="number" name="no_wa" 
                                       class="form-control @error('no_wa') is-invalid @enderror" 
                                       value="{{ old('no_wa') }}" placeholder="08..." required>
                                @error('no_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email</label>
                            <input type="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="admin@lumica.com" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Password</label>
                                <input type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Minimal 8 karakter" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark btn-lg fw-bold shadow-lg">
                                <i class="bi bi-shield-check me-2"></i> DAFTAR SEBAGAI ADMIN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none text-secondary small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Jika ERROR (Validation Failed)
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mendaftar!',
                text: 'Mohon periksa kembali inputan Anda. Pastikan Kode Rahasia benar.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Perbaiki'
            });
        @endif

        // Jika SUKSES (Session Flash)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000 // Otomatis tutup dalam 2 detik
            });
        @endif
    });
</script>
@endsection