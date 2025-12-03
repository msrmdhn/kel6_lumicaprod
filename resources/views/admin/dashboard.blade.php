@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Dashboard Overview</h3>
        <p class="text-muted mb-0">Analisis performa bisnis Lumica Production.</p>
    </div>
    
    <form action="{{ route('dashboard') }}" method="GET" class="bg-white p-2 rounded shadow-sm border d-flex align-items-center">
        <span class="text-muted small fw-bold me-2 text-uppercase">Periode:</span>
        <select name="year" class="form-select border-0 fw-bold bg-light py-2" style="min-width: 120px; cursor: pointer;" onchange="this.form.submit()">
            @foreach($availableYears as $year)
                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                    Tahun {{ $year }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 small text-uppercase fw-bold">Total Pesanan</h6>
                    <h2 class="fw-bold mb-0">{{ $totalOrders }}</h2> 
                </div>
                <i class="bi bi-cart-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="opacity-75 small text-uppercase fw-bold">Perlu Diproses</h6>
                    <h2 class="fw-bold mb-0">{{ $pendingOrders }}</h2>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 small text-uppercase fw-bold">Total Pendapatan</h6>
                    <h2 class="fw-bold mb-0">Rp {{ number_format($revenue / 1000000, 1, ',', '.') }}jt</h2>
                </div>
                <i class="bi bi-graph-up-arrow fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info text-white h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 small text-uppercase fw-bold">Pelanggan</h6>
                    <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-primary">
                    <i class="bi bi-graph-up-arrow me-2"></i>Tren Pendapatan Bulanan
                </h5>
            </div>
            <div class="card-body">
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-warning">
                    <i class="bi bi-bar-chart-fill me-2"></i>Jumlah Pesanan Per Paket
                </h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div style="height: 300px; width: 100%;">
                    <canvas id="packageChart"></canvas>
                </div>
                <div class="mt-3 text-muted small text-center">
                    Data berdasarkan pesanan lunas di tahun {{ $selectedYear }}.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold">Pesanan Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="p-3">ID</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td class="p-3">#ORDER-{{ $order->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->recipient_name }}</div>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->product->name }}</td>
                        <td>
                            @if($order->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'paid') <span class="badge bg-success">Lunas</span>
                            @elseif($order->status == 'completed') <span class="badge bg-secondary">Selesai</span>
                            @else <span class="badge bg-danger">Batal</span> @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-dark">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada pesanan terbaru hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // CHART 1: LINE CHART (PENDAPATAN)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: @json($monthsLabel),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($chartRevenueData),
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderWidth: 2,
                    tension: 0, 
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return 'Rp ' + (value/1000) + 'k'; }
                        }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // CHART 2: BAR CHART (PAKET TERLARIS - SATUAN)
        // UBAH DARI DOUGHNUT KE BAR
        const ctxPackage = document.getElementById('packageChart').getContext('2d');
        const packageData = @json($chartPackageData);
        const packageLabels = @json($chartPackageLabels);
        
        // Cek data kosong
        if (packageData.length === 0 || packageData.every(val => val === 0)) {
            // Tampilkan teks jika kosong
            ctxPackage.font = "14px Arial";
            ctxPackage.textAlign = "center";
            ctxPackage.fillText("Belum ada data penjualan", 150, 150);
        } else {
            new Chart(ctxPackage, {
                type: 'bar',
                data: {
                    labels: packageLabels,
                    datasets: [{
                        label: 'Jumlah Pesanan', 
                        data: packageData,
                        backgroundColor: [
                            'rgba(255, 193, 7, 0.8)', // Kuning
                            'rgba(33, 37, 41, 0.8)',  // Hitam
                            'rgba(13, 110, 253, 0.8)' // Biru
                        ],
                        borderColor: [
                            '#ffc107',
                            '#212529',
                            '#0d6efd'
                        ],
                        borderWidth: 1,
                        barThickness: 40, 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.raw + ' Pesanan';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, 
                                precision: 0
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Order'
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection