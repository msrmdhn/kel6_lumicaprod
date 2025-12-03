<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Wajib untuk query grafik

class AdminController extends Controller
{
public function index(Request $request)
    {
        // --- 1. SETUP FILTER TAHUN ---
        // Ambil tahun dari request, jika tidak ada pakai tahun sekarang
        $selectedYear = $request->input('year', date('Y'));

        // Cari tahun berapa saja yang ada di database (untuk opsi dropdown)
        $availableYears = Order::selectRaw('YEAR(booking_date) as year')
                               ->distinct()
                               ->orderBy('year', 'desc')
                               ->pluck('year')
                               ->toArray();

        // Jika database kosong, sediakan setidaknya tahun ini
        if (empty($availableYears)) {
            $availableYears = [date('Y')];
        }

        // --- 2. KARTU STATISTIK (GLOBAL) ---
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalUsers = User::where('role', 'user')->count();
        
        // Revenue Total (Seumur Hidup)
        $revenue = Order::whereIn('status', ['paid', 'completed'])
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->sum('products.price');

        // --- 3. DATA GRAFIK 1: OMSET PER BULAN (LINE CHART) ---
        $monthlySales = Order::select(
                            DB::raw('MONTH(booking_date) as month'), 
                            DB::raw('SUM(products.price) as total')
                        )
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->whereIn('status', ['paid', 'completed'])
                        ->whereYear('booking_date', $selectedYear) // Filter Tahun
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('total', 'month')
                        ->toArray();

        // Normalisasi data 12 bulan
        $chartRevenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartRevenueData[] = $monthlySales[$i] ?? 0;
        }
        $monthsLabel = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // --- 4. DATA GRAFIK 2: PENJUALAN PER PAKET (DOUGHNUT CHART) ---
        $packageSales = Order::select(
                            'products.name', 
                            DB::raw('COUNT(orders.id) as total_order')
                        )
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->whereIn('status', ['paid', 'completed'])
                        ->whereYear('booking_date', $selectedYear) // Filter Tahun
                        ->groupBy('products.name')
                        ->pluck('total_order', 'products.name')
                        ->toArray();

        $chartPackageLabels = array_keys($packageSales); // Nama Paket (Personal, Group, dll)
        $chartPackageData = array_values($packageSales); // Jumlah Ordernya

        // --- 5. TABEL TERBARU ---
        $recentOrders = Order::with(['product', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalUsers', 'revenue', 'recentOrders',
            'chartRevenueData', 'monthsLabel', // Data Grafik 1
            'chartPackageLabels', 'chartPackageData', // Data Grafik 2
            'selectedYear', 'availableYears' // Data Filter
        ));
    }
}