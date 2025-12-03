<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. LIHAT DAFTAR PAKET
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // 2. FORM TAMBAH PAKET
    public function create()
    {
        return view('admin.products.create');
    }

    // 3. SIMPAN PAKET BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', // Harga wajib angka
            'description' => 'required|string',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Paket foto berhasil ditambahkan!');
    }

    // 4. FORM EDIT PAKET
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // 5. UPDATE PAKET
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Paket foto berhasil diperbarui!');
    }

    // 6. HAPUS PAKET
    public function destroy(Product $product)
    {
        // Cek apakah paket ini sudah pernah dipesan orang?
        // Jika sudah, sebaiknya jangan dihapus permanen agar riwayat order tidak rusak.
        // Tapi untuk sekarang kita izinkan hapus saja.
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Paket foto dihapus.');
    }
}