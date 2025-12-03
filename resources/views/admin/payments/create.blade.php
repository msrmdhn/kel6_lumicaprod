@extends('layouts.admin')

@section('content')
<div class="mb-3">
    <a href="{{ route('payments.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Tambah Rekening Bank</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Bank / E-Wallet</label>
                        <input type="text" name="bank_name" class="form-control" placeholder="Contoh: Bank BCA atau GoPay" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="number" name="account_number" class="form-control font-monospace" placeholder="Contoh: 1234567890" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Atas Nama (Pemilik)</label>
                        <input type="text" name="account_holder" class="form-control" placeholder="Contoh: Lumica Project" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-save me-1"></i> Simpan Rekening
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection