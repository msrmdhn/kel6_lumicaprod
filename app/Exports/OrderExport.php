<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Ambil data dari database
    */
    public function collection()
    {
        return Order::with(['user', 'product'])->get();
    }

    /**
    * Judul Kolom di Excel (Header)
    */
    public function headings(): array
    {
        return [
            'ID Order',
            'Tanggal Booking',
            'Nama Pemesan',
            'Paket Foto',
            'Harga',
            'Status',
            'Metode Bayar',
        ];
    }

    /**
    * Isi Data per Baris
    */
    public function map($order): array
    {
        return [
            '#ORDER-' . $order->id,
            $order->booking_date,
            $order->recipient_name,
            $order->product->name,
            'Rp ' . number_format($order->product->price, 0, ',', '.'),
            strtoupper($order->status), // Uppercase (PENDING/PAID)
            $order->payment_method,
        ];
    }
}