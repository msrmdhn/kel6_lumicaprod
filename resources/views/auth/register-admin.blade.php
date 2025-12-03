@extends('layouts.app')

@section('title', 'Daftar Admin - RAHASIA')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-danger">
                <div class="card-header bg-danger text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">⚠️ KHUSUS ADMIN LUMICA</h4>
                    <small>Halaman ini bersifat rahasia.</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('register.admin.process') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-danger">Kode Rahasia Tim</label>
                            <input type="password" name="secret_key" class="form-control border-danger" placeholder="Masukkan kode rahasia..." required>
                            <div class="form-text">Tanya developer jika tidak tahu kodenya.</div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. WhatsApp</label>
                                <input type="number" name="no_wa" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Min 8 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger fw-bold">DAFTAR SEBAGAI ADMIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection