@extends('layouts.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Detail Customer</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="col-form-label">Nama Customer:</label>
                <input class="form-control" value="{{ $customer->name }}" readonly>

                <label for="code_customer" class="col-form-label">Kode Customer:</label>
                <input class="form-control" value="{{ $customer->code_customer }}" readonly>

                <label for="lot_no" class="col-form-label">Lot Number:</label>
                <input class="form-control" name="lot_no" type="text" id="lot_no" value="{{ $customer->lot_no }}"
                    readonly>

                <label for="no_tlp" class="col-form-label">No. Telepon Customer:</label>
                <input class="form-control" value="{{ $customer->no_tlp }}" readonly>

                <label for="address" class="col-form-label">Alamat Customer:</label>
                <textarea class="form-control" readonly>{{ $customer->address }}</textarea>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{ route('dashboard.customer.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
