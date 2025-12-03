<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        // Ambil data paket. Jika kosong, fungsi compact akan mengirim array kosong.
        $products = Product::all();
        
        // Debugging: Jika produk kosong, kode di view akan error/loop tidak jalan.
        // Tapi dengan perbaikan seeder di atas, ini aman.
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'delivery_email' => 'required|email',
            'backup_no_wa' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
            'booking_date' => 'required|date|after:today',
            'payment_method' => 'required',
            'payment_proof' => 'required|image|max:2048',
        ]);

        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'recipient_name' => $request->recipient_name,
            'delivery_email' => $request->delivery_email,
            'backup_no_wa' => $request->backup_no_wa,
            'booking_date' => $request->booking_date,
            'payment_method' => $request->payment_method,
            'payment_proof' => $proofPath,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.create')->with('success', 'Pesanan berhasil dikirim! Mohon tunggu konfirmasi admin.');
    }
}