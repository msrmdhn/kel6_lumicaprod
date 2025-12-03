<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    // 1. TAMPILKAN DAFTAR
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.portfolios.create');
    }

    // 3. PROSES SIMPAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('portfolios', 'public');

        Portfolio::create([
            'title' => $request->title,
            'category' => $request->category,
            'image_path' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    // 4. FORM EDIT (BARU)
    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    // 5. PROSES UPDATE (BARU)
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image jadi nullable (tidak wajib ganti)
            'description' => 'nullable|string',
        ]);

        // Cek apakah user upload gambar baru?
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama
            if (Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
            // 2. Upload gambar baru
            $imagePath = $request->file('image')->store('portfolios', 'public');
            
            // 3. Update path di database
            $portfolio->update(['image_path' => $imagePath]);
        }

        // Update data teks
        $portfolio->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Data berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy(Portfolio $portfolio)
    {
        if (Storage::disk('public')->exists($portfolio->image_path)) {
            Storage::disk('public')->delete($portfolio->image_path);
        }
        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Data berhasil dihapus!');
    }
}