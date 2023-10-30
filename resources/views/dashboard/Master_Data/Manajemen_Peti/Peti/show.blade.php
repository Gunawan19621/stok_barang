@extends('layouts.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Tambah Tipe Peti</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="tipe_peti_id" class="col-form-label">Tipe Peti:</label>
                <input class="form-control" value="{{ $peti->tipe_peti->type }}" readonly>

                <label for="warna" class="col-form-label">Warna Peti:</label>
                <input class="form-control" value="{{ $peti->warna }}" readonly>

                <label for="customer_id" class="col-form-label">Customer:</label>
                <input class="form-control" value="{{ $peti->customer->name }}" readonly>

                <label for="warehouse_id" class="col-form-label">Warehouse:</label>
                <input class="form-control" value="{{ $peti->warehouse->name }}" readonly>

                <label for="status_disposal" class="col-form-label">Status Peti:</label>
                <input class="form-control" value="{{ $peti->status_disposal }}" readonly>

                <label for="jumlah" class="col-form-label">Jumlah Peti:</label>
                <input class="form-control" value="{{ $peti->jumlah }}" readonly>

                <label for="date_pembuatan" class="col-form-label">Tanggal Pembuatan Peti:</label>
                <input class="form-control" value="{{ \Carbon\Carbon::parse($peti->date_pembuatan)->format('d/m/Y') }}"
                    readonly>

                <label for="fix_lot" class="col-form-label">QR Code:</label>
                <div>
                    {!! QrCode::size(75)->generate(
                        'Nama Customer : ' .
                            $peti->customer->name .
                            "\n" .
                            'Code Customer : ' .
                            $peti->customer->code_customer .
                            "\n" .
                            'Type Peti : ' .
                            $peti->tipe_peti->type .
                            "\n" .
                            'Warehouse : ' .
                            $peti->warehouse->name .
                            "\n" .
                            'Ukuran Peti : ' .
                            $peti->tipe_peti->size_peti .
                            "\n" .
                            'Lot Number : ' .
                            $peti->customer->lot_no .
                            "\n" .
                            'Paking Number : ' .
                            $peti->packing_no .
                            "\n" .
                            'Status Peti : ' .
                            $peti->status_disposal,
                    ) !!}
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.peti.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
