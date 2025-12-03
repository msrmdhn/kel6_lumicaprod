<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    // Lihat Daftar Bank
    public function index()
    {
        $banks = PaymentMethod::all();
        return view('admin.payments.index', compact('banks'));
    }

    // Form Tambah
    public function create()
    {
        return view('admin.payments.create');
    }

    // Simpan Bank Baru
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
        ]);

        PaymentMethod::create($request->all());
        return redirect()->route('payments.index')->with('success', 'Rekening berhasil ditambahkan');
    }

    // Form Edit
    public function edit(PaymentMethod $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    // Update Bank
    public function update(Request $request, PaymentMethod $payment)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
        ]);

        $payment->update($request->all());
        return redirect()->route('payments.index')->with('success', 'Rekening berhasil diupdate');
    }

    // Hapus Bank
    public function destroy(PaymentMethod $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Rekening dihapus');
    }
}