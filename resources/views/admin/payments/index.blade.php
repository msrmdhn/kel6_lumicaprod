@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <h3>Kelola Rekening Bank</h3>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">Tambah Bank</a>
</div>
<div class="card p-3">
    <table class="table">
        <thead><tr><th>Bank</th><th>No. Rek</th><th>A.N</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>{{ $bank->bank_name }}</td>
                <td>{{ $bank->account_number }}</td>
                <td>{{ $bank->account_holder }}</td>
                <td>
                    <a href="{{ route('payments.edit', $bank->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('payments.destroy', $bank->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection