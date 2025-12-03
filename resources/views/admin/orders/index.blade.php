@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-0">Pesanan Masuk</h3>
        <span class="badge bg-primary fs-6">{{ $orders->count() }} Total Pesanan</span>
    </div>
    
    <div class="d-flex gap-2">
        <a href="{{ route('admin.orders.export.excel') }}" class="btn btn-success text-white shadow-sm">
            <i class="bi bi-file-earmark-excel-fill"></i> Excel
        </a>
        <a href="{{ route('admin.orders.export.pdf') }}" class="btn btn-danger text-white shadow-sm">
            <i class="bi bi-file-earmark-pdf-fill"></i> PDF
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="p-3">ID Order</th>
                        <th>Pemesan</th>
                        <th>Paket Foto</th>
                        <th>Tanggal Booking</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="p-3 fw-bold text-secondary">#ORDER-{{ $order->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->recipient_name }}</div>
                            <small class="text-muted"><i class="bi bi-whatsapp"></i> {{ $order->backup_no_wa }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $order->product->name }}</span>
                            <div class="small text-muted">Rp {{ number_format($order->product->price, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            {{ date('d M Y', strtotime($order->booking_date)) }}
                        </td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Bayar</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-success">Sudah Bayar</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-secondary">Selesai</span>
                            @else
                                <span class="badge bg-danger">Batal</span>
                            @endif
                        <td>
                            <div class="d-flex gap-1">
                                <!-- Tombol Detail -->
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-dark">
                                    Detail
                                </a>

                                <!-- Logika Tombol Hapus (Cuma muncul kalau status Cancelled) -->
                                @if($order->status == 'cancelled')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus permanen pesanan #ORDER-{{ $order->id }} ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pesanan Batal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection