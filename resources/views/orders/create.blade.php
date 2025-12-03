@extends('layouts.app')

@section('title', 'Form Pemesanan - Lumica Production')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border-0 mb-4 rounded-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-octagon-fill fs-4 me-3"></i>
                        <div>
                            <strong>Ups! Ada kesalahan input.</strong><br>
                            Silakan periksa kolom yang berwarna merah di bawah ini.
                        </div>
                    </div>
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white p-4">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-camera me-2"></i> Form Order Jasa Foto</h4>
                    <p class="mb-0 small text-white-50 opacity-75">Isi formulir manual di bawah ini dengan lengkap.</p>
                </div>
                
                <div class="card-body p-4 bg-white">
                    
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning text-dark me-2 rounded-pill">1</span>
                            <h5 class="fw-bold mb-0 text-dark">Data Pemesan</h5>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Nama Lengkap</label>
                            <input type="text" name="recipient_name" 
                                   class="form-control form-control-lg @error('recipient_name') is-invalid @enderror" 
                                   placeholder="Contoh: Budi Santoso" 
                                   value="{{ old('recipient_name') }}">
                            @error('recipient_name')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> Nama wajib diisi.</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-uppercase">Email Pengiriman</label>
                                <input type="email" name="delivery_email" 
                                       class="form-control @error('delivery_email') is-invalid @enderror" 
                                       placeholder="budi@gmail.com" 
                                       value="{{ old('delivery_email') }}">
                                @error('delivery_email')
                                    <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> Email tidak valid.</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-uppercase">No. WhatsApp (Aktif)</label>
                                <input type="number" name="backup_no_wa" 
                                       class="form-control @error('backup_no_wa') is-invalid @enderror" 
                                       placeholder="0812xxxxxxxx" 
                                       value="{{ old('backup_no_wa') }}">
                                @error('backup_no_wa')
                                    <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> No WA wajib angka.</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4 border-secondary opacity-10">

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning text-dark me-2 rounded-pill">2</span>
                            <h5 class="fw-bold mb-0 text-dark">Detail Paket</h5>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Pilih Paket Foto</label>
                            <select name="product_id" class="form-select form-select-lg @error('product_id') is-invalid @enderror">
                                <option value="">-- Klik Untuk Memilih --</option>
                                @foreach($products as $paket)
                                    <option value="{{ $paket->id }}" {{ old('product_id') == $paket->id ? 'selected' : '' }}>
                                        {{ $paket->name }} - Rp {{ number_format($paket->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> Silakan pilih paket dulu.</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Tanggal Sesi Foto</label>
                            <input type="date" name="booking_date" 
                                   class="form-control @error('booking_date') is-invalid @enderror" 
                                   value="{{ old('booking_date') }}">
                            @error('booking_date')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Minimal booking H-1 sebelum sesi foto.</div>
                        </div>

                        <hr class="my-4 border-secondary opacity-10">

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning text-dark me-2 rounded-pill">3</span>
                            <h5 class="fw-bold mb-0 text-dark">Pembayaran</h5>
                        </div>

                <div class="d-flex align-items-center mb-3">
                    
                    <h5 class="fw-bold mb-0 text-dark">Pilih Metode Pembayaran (Transfer Bank Only)</h5>
                </div>

                <div class="row g-3 mb-3">
                    @foreach($banks as $bank)
                    <div class="col-md-4">
                        <label class="card h-100 border p-3 cursor-pointer shadow-sm hover-effect-payment">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                    value="{{ $bank->bank_name }} ({{ $bank->account_number }})" 
                                    {{ $loop->first ? 'checked' : '' }}> <span class="form-check-label fw-bold">{{ $bank->bank_name }}</span>
                            </div>
                            
                            <div class="mt-3 ps-4">
                                <h5 class="fw-bold text-primary mb-0 font-monospace">{{ $bank->account_number }}</h5>
                                <small class="text-muted d-block">a.n {{ $bank->account_holder }}</small>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                        <div class="mb-4">
                            
                            <label class="form-label fw-bold small text-uppercase">Upload Bukti Transfer</label>
                            <input type="file" name="payment_proof" 
                                   class="form-control @error('payment_proof') is-invalid @enderror" 
                                   accept="image/*">
                            @error('payment_proof')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-x-circle"></i> Wajib upload bukti (JPG/PNG Max 2MB).</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-lg fw-bold py-3 shadow-lg">
                                <i class="bi bi-send-fill me-2"></i> KIRIM PESANAN SEKARANG
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Jika SUKSES (Dari Controller)
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ffc107'
            });
        @endif

        // 2. Jika ERROR (Dari Validasi)
        @if ($errors->any())
            Swal.fire({
                title: 'Gagal Mengirim!',
                text: 'Mohon periksa kolom yang berwarna merah. Ada data yang belum lengkap.',
                icon: 'error',
                confirmButtonText: 'Perbaiki',
                confirmButtonColor: '#dc3545'
            });
        @endif
    });
</script>

<style>
    /* Sedikit style tambahan biar kartu pembayaran enak diklik */
    .hover-effect-payment:hover {
        background-color: #f8f9fa;
        border-color: #ffc107 !important;
        cursor: pointer;
    }
</style>
@endsection