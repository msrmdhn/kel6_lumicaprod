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
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="fw-bold mb-0">Edit Rekening Bank</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Nama Bank / E-Wallet</label>
                        <input type="text" name="bank_name" class="form-control" value="{{ $payment->bank_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="number" name="account_number" class="form-control font-monospace" value="{{ $payment->account_number }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Atas Nama (Pemilik)</label>
                        <input type="text" name="account_holder" class="form-control" value="{{ $payment->account_holder }}" required>
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="statusSwitch" {{ $payment->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Tampilkan di Halaman Order?</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-warning fw-bold">
                            <i class="bi bi-check-circle me-1"></i> Update Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection