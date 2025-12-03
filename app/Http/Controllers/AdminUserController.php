<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // 1. LIHAT DAFTAR USER (SELAIN ADMIN)
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. HAPUS USER
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus user beserta semua orderannya (Cascade)
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus dari sistem.');
    }
}