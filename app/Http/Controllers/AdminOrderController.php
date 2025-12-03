<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <--- INI WAJIB ADA BIAR GA MERAH
use App\Exports\OrderExport;       
use Maatwebsite\Excel\Facades\Excel; 
use Barryvdh\DomPDF\Facade\Pdf;    

class AdminOrderController extends Controller
{
    // 1. LIHAT SEMUA PESANAN
    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 2. LIHAT DETAIL PESANAN
    public function show($id)
    {
        $order = Order::with(['user', 'product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // 3. UPDATE STATUS
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // 4. HAPUS PESANAN (DENGAN SYARAT SUDAH BATAL)
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Validasi: Hanya boleh hapus jika status 'cancelled'
        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Gagal! Hanya pesanan status "Batal" yang boleh dihapus.');
        }

        // Hapus Foto Bukti Bayar dari Penyimpanan
        if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();
        
        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan sampah berhasil dibersihkan.');
    }

    // 5. FITUR TRACKING ORDER
    public function tracking(Request $request)
    {
        $search = $request->query('search');
        $order = null;

        if ($search) {
            $cleanId = str_replace('#ORDER-', '', $search);
            $order = Order::with(['user', 'product'])->find($cleanId);
        }

        return view('admin.orders.tracking', compact('order', 'search'));
    }

    // 6. EXPORT EXCEL
    public function exportExcel()
    {
        return Excel::download(new OrderExport, 'laporan-pesanan-lumica.xlsx');
    }

    // 7. EXPORT PDF
    public function exportPdf()
    {
        $orders = Order::with('product')->get();
        $pdf = Pdf::loadView('admin.orders.pdf', compact('orders'));
        return $pdf->download('laporan-pesanan-lumica.pdf');
    }
}