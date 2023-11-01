@extends('layouts.main')
@section('content')
    @include('layouts.components.alert-prompt')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Edit Customer</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.customer.update', [$customer->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama Customer:</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ $customer->name }}"
                        placeholder="Masukan nama customer" required>

                    <label for="code_customer" class="col-form-label">Kode Customer:</label>
                    <input class="form-control" name="code_customer" type="text" id="code_customer"
                        value="{{ $customer->code_customer }}" placeholder="Masukan kode customer" required>

                    <label for="lot_no" class="col-form-label">Lot Number:</label>
                    <input class="form-control" name="lot_no" type="text" id="lot_no" value="{{ $customer->lot_no }}"
                        placeholder="Masukan lot number" required>

                    <label for="no_tlp" class="col-form-label">No. Telepon Customer:</label>
                    <input class="form-control" name="no_tlp" type="text" id="no_tlp" value="{{ $customer->no_tlp }}"
                        placeholder="Masukan nomor telepon customer" required>

                    <label for="address" class="col-form-label">Alamat Customer:</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat customer" required>{{ $customer->address }}</textarea>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.customer.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
