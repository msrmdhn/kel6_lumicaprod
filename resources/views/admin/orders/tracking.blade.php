@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Tracking Order (Cari Pesanan)</h3>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.tracking') }}" method="GET">
            <label class="form-label fw-bold">Masukkan ID Pesanan</label>
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-light text-muted">#ORDER-</span>
                <input type="text" name="search" class="form-control" 
                       placeholder="Contoh: 1, 5, 12" 
                       value="{{ $search }}" required autofocus>
                <button class="btn btn-dark px-4" type="submit">
                    <i class="bi bi-search me-2"></i> Cari
                </button>
            </div>
            <div class="form-text mt-2">Cukup ketik angkanya saja. Contoh: Jika ID <b>#ORDER-5</b>, ketik <b>5</b>.</div>
        </form>
    </div>
</div>

@if($search)
    @if($order)
        <div class="card border-0 shadow border-start border-5 border-success slide-up">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-2">
                            <h4 class="fw-bold mb-0 me-3">Ditemukan: #ORDER-{{ $order->id }}</h4>
                            
                            @if($order->status == 'pending') 
                                <span class="badge bg-warning text-dark px-3 py-2">Menunggu Bayar</span>
                            @elseif($order->status == 'paid') 
                                <span class="badge bg-success px-3 py-2">Lunas / Diproses</span>
                            @elseif($order->status == 'completed') 
                                <span class="badge bg-secondary px-3 py-2">Selesai</span>
                            @else 
                                <span class="badge bg-danger px-3 py-2">Dibatalkan</span> 
                            @endif
                        </div>

                        <p class="mb-1 text-muted">Pemesan: <strong class="text-dark">{{ $order->recipient_name }}</strong></p>
                        <p class="mb-1 text-muted">Paket: <strong class="text-dark">{{ $order->product->name }}</strong></p>
                        <p class="mb-0 text-muted">Tanggal: <strong>{{ date('d M Y', strtotime($order->booking_date)) }}</strong></p>
                    </div>
                    
                    <div class="col-md-4 text-end mt-3 mt-md-0">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-dark btn-lg w-100">
                            Lihat Detail Lengkap <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center py-5 border-0 shadow-sm">
            <i class="bi bi-search fs-1 d-block mb-3 opacity-50"></i>
            <h4 class="fw-bold">Pesanan Tidak Ditemukan</h4>
            <p class="text-muted mb-0">Sistem tidak dapat menemukan data dengan ID: <strong>{{ $search }}</strong></p>
            <small>Pastikan Anda memasukkan angka ID yang benar.</small>
        </div>
    @endif
@endif

<style>
    /* Animasi Halus */
    .slide-up { animation: slideUp 0.5s ease; }
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>
@endsection