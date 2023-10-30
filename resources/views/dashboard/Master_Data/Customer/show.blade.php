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
                <input class="form-control" name="name" type="text" id="name" value="{{ $customer->name }}"
                    readonly>

                <label for="code_customer" class="col-form-label">Kode Customer:</label>
                <input class="form-control" name="code_customer" type="text" id="code_customer"
                    value="{{ $customer->code_customer }}" readonly>

                <label for="lot_no" class="col-form-label">Lot Number:</label>
                <input class="form-control" name="lot_no" type="text" id="lot_no" value="{{ $customer->lot_no }}"
                    readonly>

                <label for="nip" class="col-form-label">NIP Customer:</label>
                <input class="form-control" name="nip" type="text" id="nip" value="{{ $customer->nip }}"
                    readonly>

                <label for="no_hp" class="col-form-label">No. HP Customer:</label>
                <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{ $customer->no_hp }}"
                    readonly>

                <label for="tgl_lahir" class="col-form-label">Tanggal Lahir Customer:</label>
                <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir"
                    value="{{ $customer->tgl_lahir }}" readonly>

                <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin Customer:</label>
                <input class="form-control" name="jenis_kelamin" type="text" id="jenis_kelamin"
                    value="{{ $customer->jenis_kelamin }}" readonly>

                <label for="agama" class="col-form-label">Agama Customer:</label>
                <input class="form-control" name="agama" type="text" id="agama" value="{{ $customer->agama }}"
                    readonly>

                <label for="address" class="col-form-label">Alamat Customer:</label>
                <textarea class="form-control" name="address" id="address" readonly>{{ $customer->address }}</textarea>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{ route('dashboard.customer.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
