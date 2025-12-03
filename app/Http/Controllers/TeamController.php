<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    // 1. DAFTAR TIM
    public function index()
    {
        $teams = Team::all();
        return view('admin.teams.index', compact('teams'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.teams.create');
    }

    // 3. SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'required|image|max:2048', // Max 2MB
            'instagram' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
        ]);

        $imagePath = $request->file('image')->store('teams', 'public');

        Team::create([
            'name' => $request->name,
            'role' => $request->role,
            'image_path' => $imagePath,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('teams.index')->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    // 4. FORM EDIT
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    // 5. UPDATE DATA
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama
            if (Storage::disk('public')->exists($team->image_path)) {
                Storage::disk('public')->delete($team->image_path);
            }
            // Upload baru
            $imagePath = $request->file('image')->store('teams', 'public');
            $team->update(['image_path' => $imagePath]);
        }

        $team->update([
            'name' => $request->name,
            'role' => $request->role,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('teams.index')->with('success', 'Data tim berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy(Team $team)
    {
        if (Storage::disk('public')->exists($team->image_path)) {
            Storage::disk('public')->delete($team->image_path);
        }
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Anggota tim dihapus.');
    }
}