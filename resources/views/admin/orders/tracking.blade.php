@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Tracking Order (Cari Pesanan)</h3>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.tracking') }}" method="GET">
            <label class="form-label fw-bold">Masukkan ID Order</label>
            <div class="input-group input-group-lg">
                <span class="input-group-text">#ORDER-</span>
                <input type="number" name="search" class="form-control" placeholder="Contoh: 1, 2, 15..." value="{{ $search }}" required>
                <button class="btn btn-dark" type="submit">Cari <i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

@if($search)
    @if($order)
        <div class="card border-0 shadow border-start border-5 border-success">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="fw-bold">Ditemukan: #ORDER-{{ $order->id }}</h4>
                        <p class="mb-1">Pemesan: <strong>{{ $order->recipient_name }}</strong></p>
                        <p class="mb-1">Paket: <span class="badge bg-info text-dark">{{ $order->product->name }}</span></p>
                        <p class="mb-0">Status: 
                            @if($order->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'paid') <span class="badge bg-success">Lunas</span>
                            @elseif($order->status == 'completed') <span class="badge bg-secondary">Selesai</span>
                            @else <span class="badge bg-danger">Batal</span> @endif
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-dark">Lihat Detail Lengkap</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center py-4">
            <i class="bi bi-x-circle fs-1 d-block mb-2"></i>
            <h5>Pesanan Tidak Ditemukan</h5>
            <p>Tidak ada pesanan dengan ID #ORDER-{{ $search }}</p>
        </div>
    @endif
@endif
@endsection