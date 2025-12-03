@extends('layouts.app')

@section('title', 'Login - Lumica Production')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">LOGIN USER</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf 
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">MASUK</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></small>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('register.admin') }}" class="small text-muted text-decoration-none">
                            Daftar Akun Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection