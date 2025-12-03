<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; 

// Route untuk membersihkan cache di Vercel
Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return "Cache Cleared!";
});
// --- 1. HALAMAN DEPAN (PUBLIC) ---
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/portfolios-gallery', [PublicController::class, 'portfolio'])->name('public.portfolio');
Route::get('/about-team', [PublicController::class, 'team'])->name('public.team');
Route::get('/credits-dev', [PublicController::class, 'credit'])->name('public.credit');


// --- 2. TAMU (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// --- 3. MEMBER & ADMIN (AUTH) ---
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- FITUR ORDER USER ---
    Route::get('/order', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');


    // --- AREA ADMIN ---
    
    // Group dengan prefix 'admin'
    Route::prefix('admin')->name('admin.')->group(function() {
        // 1. Manajemen Pesanan
        // EXPORT EXCEL & PDF
        Route::get('orders/export/excel', [AdminOrderController::class, 'exportExcel'])->name('orders.export.excel');
        Route::get('orders/export/pdf', [AdminOrderController::class, 'exportPdf'])->name('orders.export.pdf');

        // 1. Manajemen Pesanan (Yang Lama)
        Route::resource('orders', AdminOrderController::class);
        Route::resource('orders', AdminOrderController::class);
        
        // 2. Tracking Order
        Route::get('/tracking', [AdminOrderController::class, 'tracking'])->name('tracking');

        // 3. Kelola User
        Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);

        // 4. Edit Profil Admin
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // CRUD Dashboard Lainnya
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('credits', CreditController::class);
    
    // CRUD PAKET FOTO (PRODUK)
    Route::resource('products', ProductController::class);
});