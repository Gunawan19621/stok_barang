@extends('layouts.main')
@section('title', 'Setting Platform')
@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h1 class="h3 mb-1 text-gray-800 mb-3">Detail Asset</h1>
                <hr class="border">
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama Asset:</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ $asset->name }}"
                        placeholder="Masukan Nama Asset" required readonly>

                    <label for="description" class="col-form-label">Deskripsi Asset:</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Asset" required
                        readonly>{{ $asset->description }}</textarea>

                    <label for="qr_count" class="col-form-label">QR:</label>
                    <div>
                        {!! QrCode::size(75)->generate(
                            'Name: ' .
                                $asset->name .
                                "\n" .
                                'Description: ' .
                                $asset->description .
                                "\n" .
                                'QR Code: ' .
                                $asset->qr_count .
                                "\n" .
                                'Date: ' .
                                $asset->date .
                                "\n" .
                                'Warehouse ID: ' .
                                $asset->warehouse_id,
                        ) !!}
                    </div>

                    <label for="date" class="col-form-label">Tanggal:</label>
                    <input class="form-control" name="date" type="date" id="date"
                        value="{{ \Carbon\Carbon::parse($asset->date)->format('Y-m-d') }}"
                        placeholder="Masukan Tanggal Asset" required readonly>

                    <label for="warehouse_id" class="col-form-label">Gudang:</label>
                    <select class="form-control" name="warehouse_id" id="warehouse_id" disabled>
                        <option disabled selected>Pilih Asal Gudang</option>
                        @foreach ($warehouse as $data_warehouse)
                            <option value="{{ $data_warehouse->id }}"
                                @if ($data_warehouse->id == $asset->warehouse_id) selected
                                        @else @endif>
                                {{ $data_warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('dashboard.asset.index') }}" class="btn btn-primary ">Kembali</a>
            </div>
        </div>
    </div>
@endsection
