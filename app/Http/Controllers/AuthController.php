<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm() {
        return view('auth.login');
    }

    // Tampilkan Form Register
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // CEK ROLE: Admin ke Dashboard, User ke Home
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => 'Login Gagal. Cek username/password.',
        ]);
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'no_wa' => 'required|numeric',
            
            // ATURAN KUNCI: 'confirmed'
            // Ini akan otomatis mencari input bernama 'password_confirmation'
            'password' => 'required|min:8|confirmed', 
        ], [
            // Kita kustomisasi pesan errornya biar bahasa Indonesia
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password utama.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'username.unique' => 'Username ini sudah dipakai orang lain.',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi Berhasil! Silakan Login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}