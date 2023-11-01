@extends('layouts.main')
@section('content')
    @include('layouts.components.alert-prompt')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Edit Peti</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.peti.update', [$peti->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="tipe_peti_id" class="col-form-label">Tipe Peti:</label>
                    <select class="form-control" name="tipe_peti_id" id="tipe_peti_id">
                        <option disabled selected>Pilih Warehouse</option>
                        @foreach ($typepeti as $data_type)
                            <option value="{{ $data_type->id }}"
                                @if ($data_type->id == $peti->tipe_peti_id) selected
                                    @else @endif>
                                {{ $data_type->type }}</option>
                        @endforeach
                    </select>

                    <label for="warna" class="col-form-label">Warna Peti:</label>
                    <input class="form-control" name="warna" type="text" id="warna" value="{{ $peti->warna }}"
                        placeholder="Masukan Warna Peti" required>

                    <label for="customer_id" class="col-form-label">Customer:</label>
                    <select class="form-control" name="customer_id" id="customer_id">
                        <option disabled selected>Pilih Warehouse</option>
                        @foreach ($customer as $data_customer)
                            <option value="{{ $data_customer->id }}"
                                @if ($data_customer->id == $peti->customer_id) selected
                                    @else @endif>
                                {{ $data_customer->name }}</option>
                        @endforeach
                    </select>

                    <label for="warehouse_id" class="col-form-label">Warehouse:</label>
                    <select class="form-control" name="warehouse_id" id="warehouse_id">
                        <option disabled selected>Pilih Warehouse</option>
                        @foreach ($warehouse as $data_warehouse)
                            <option value="{{ $data_warehouse->id }}"
                                @if ($data_warehouse->id == $peti->warehouse_id) selected
                                    @else @endif>
                                {{ $data_warehouse->name }}</option>
                        @endforeach
                    </select>

                    <label for="status_disposal" class="col-form-label">Status Peti:</label>
                    <input class="form-control" name="status_disposal" type="text" id="status_disposal"
                        value="{{ $peti->status_disposal }}" placeholder="Masukan status Peti">

                    <label for="date_pembuatan" class="col-form-label">Tanggal Pembuatan Peti:</label>
                    <input class="form-control" name="date_pembuatan" type="date" id="date_pembuatan"
                        value="{{ $peti->date_pembuatan }}" required>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.peti.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
