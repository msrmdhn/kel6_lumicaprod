@extends('layouts.admin')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Detail Pesanan #ORDER-{{ $order->id }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="30%" class="text-muted">Nama Pemesan</td>
                        <td class="fw-bold">{{ $order->recipient_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email Pengiriman</td>
                        <td>{{ $order->delivery_email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. WhatsApp</td>
                        <td>
                            {{ $order->backup_no_wa }}
                            <a href="https://wa.me/{{ $order->backup_no_wa }}" target="_blank" class="btn btn-success btn-sm ms-2 rounded-pill">
                                <i class="bi bi-whatsapp"></i> Chat
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Paket Dipilih</td>
                        <td class="fw-bold text-primary">{{ $order->product->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga</td>
                        <td class="fw-bold">Rp {{ number_format($order->product->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Sesi</td>
                        <td>{{ date('d F Y', strtotime($order->booking_date)) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Metode Bayar</td>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Bukti Pembayaran</h5>
            </div>
            <div class="card-body text-center bg-light">
                @if($order->payment_proof)
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px">
                @else
                    <span class="text-muted">Tidak ada bukti pembayaran.</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Ubah Status Pesanan</h6>
                
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <select name="status" class="form-select form-select-lg mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🟡 Pending (Menunggu)</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>🟢 Paid (Lunas/Valid)</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>🔵 Completed (Selesai)</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled (Tolak)</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info small">
            <i class="bi bi-info-circle-fill me-1"></i> 
            Jika status diubah menjadi <strong>Paid</strong>, pastikan uang sudah masuk ke rekening.
        </div>
    </div>
</div>
@endsection