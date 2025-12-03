<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreditController extends Controller
{
    // 1. DAFTAR DEVELOPER
    public function index()
    {
        $credits = Credit::all();
        return view('admin.credits.index', compact('credits'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.credits.create');
    }

    // 3. SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim'  => 'required|string|max:20',
            'role' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'github_url' => 'nullable|url',
        ]);

        $imagePath = $request->file('image')->store('credits', 'public');

        Credit::create([
            'name' => $request->name,
            'nim'  => $request->nim,
            'role' => $request->role,
            'image_path' => $imagePath,
            'description' => $request->description,
            'github_url' => $request->github_url,
        ]);

        return redirect()->route('credits.index')->with('success', 'Developer berhasil ditambahkan!');
    }

    // 4. FORM EDIT
    public function edit(Credit $credit)
    {
        return view('admin.credits.edit', compact('credit'));
    }

    // 5. UPDATE DATA
    public function update(Request $request, Credit $credit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim'  => 'required|string|max:20',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($credit->image_path)) {
                Storage::disk('public')->delete($credit->image_path);
            }
            $imagePath = $request->file('image')->store('credits', 'public');
            $credit->update(['image_path' => $imagePath]);
        }

        $credit->update([
            'name' => $request->name,
            'nim'  => $request->nim,
            'role' => $request->role,
            'description' => $request->description,
            'github_url' => $request->github_url,
        ]);

        return redirect()->route('credits.index')->with('success', 'Data developer diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy(Credit $credit)
    {
        if (Storage::disk('public')->exists($credit->image_path)) {
            Storage::disk('public')->delete($credit->image_path);
        }
        $credit->delete();
        return redirect()->route('credits.index')->with('success', 'Data dihapus.');
    }
}