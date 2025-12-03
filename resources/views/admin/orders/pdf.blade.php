<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesanan - Lumica Project</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .badge { padding: 3px 6px; color: #fff; border-radius: 4px; font-size: 10px; }
        .bg-success { background-color: green; }
        .bg-warning { background-color: orange; color: black; }
        .bg-danger { background-color: red; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pesanan Masuk</h1>
        <p>Lumica Project Photography</p>
        <small>Dicetak pada: {{ date('d F Y H:i') }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Order</th>
                <th>Nama Klien</th>
                <th>Paket</th>
                <th>Tgl Sesi</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>#ORDER-{{ $order->id }}</td>
                <td>{{ $order->recipient_name }}</td>
                <td>{{ $order->product->name }}</td>
                <td>{{ date('d/m/Y', strtotime($order->booking_date)) }}</td>
                <td>Rp {{ number_format($order->product->price, 0, ',', '.') }}</td>
                <td>
                    @if($order->status == 'paid') <span class="badge bg-success">Lunas</span>
                    @elseif($order->status == 'pending') <span class="badge bg-warning">Pending</span>
                    @else <span class="badge bg-danger">{{ $order->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>