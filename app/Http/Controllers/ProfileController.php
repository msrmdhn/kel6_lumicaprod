<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // 1. FORM EDIT PROFIL
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    // 2. UPDATE PROFIL & PASSWORD
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,'.$user->id, // Unik kecuali punya sendiri
            'password' => 'nullable|min:8|confirmed', // Password Boleh Kosong (artinya gak diganti)
        ]);

        // Update Data Diri
        $user->name = $request->name;
        $user->username = $request->username;

        // Jika password diisi, maka ganti password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil dan Password berhasil diperbarui!');
    }
}