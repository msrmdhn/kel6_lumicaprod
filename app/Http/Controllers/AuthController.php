<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // --- FITUR UMUM: LOGIN & LOGOUT ---

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek Role: Admin ke Dashboard, User ke Home
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    // --- FITUR USER: DAFTAR AKUN BIASA ---

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'no_wa' => 'required|numeric',
            'password' => 'required|min:8|confirmed', // Wajib ada input name="password_confirmation" di form
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'username.unique' => 'Username sudah dipakai.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'role' => 'user', // Default User
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Langsung login setelah daftar

        return redirect()->route('home')->with('success', 'Pendaftaran Berhasil!');
    }


    // --- FITUR RAHASIA: DAFTAR ADMIN (DEBUGGED) ---

    public function showAdminRegisterForm()
    {
        return view('auth.register-admin');
    }

    public function registerAdmin(Request $request)
    {
        // 1. Validasi Input Standar
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users', 
            'no_wa' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
            'secret_key' => 'required',
        ], [
            'email.unique' => 'Email ini SUDAH TERDAFTAR. Gunakan email lain.',
            'password.confirmed' => 'Password konfirmasi tidak sama.',
        ]);

        // 2. Cek Kunci Rahasia (VERSI DEBUG)
        // Kita bersihkan input dari spasi (trim) dan ubah ke huruf kecil (strtolower)
        $inputKey = trim(strtolower($request->secret_key));
        
        // Kunci Rahasia Anda: "l6msr"
        if ($inputKey !== 'l6msr') {
            // Kita kasih tau user apa yang server terima biar ketahuan salahnya dimana
            return back()
                ->withInput()
                ->withErrors(['secret_key' => 'SALAH! Server menerima: "' . $inputKey . '". Harusnya: "l6msr"']);
        }

        // 3. Buat User Admin
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'role' => 'admin', // Role Admin
            'password' => Hash::make($request->password),
        ]);

        // 4. Auto Login & Redirect
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Selamat! Akun Admin Berhasil Dibuat.');
    }
}