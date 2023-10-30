@extends('layouts.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Detail Tipe Peti</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="type" class="col-form-label">Tipe Peti:</label>
                <input class="form-control" name="type" type="text" id="type"
                    value="{{ $typepeti->type }}"readonly>

                <label for="size_peti" class="col-form-label">Ukuran Peti:</label>
                <input class="form-control" name="size_peti" type="text" id="size_peti"
                    value="{{ $typepeti->size_peti }}" readonly>

                <label for="description" class="col-form-label">Deskripsi Peti:</label>
                <textarea class="form-control" name="description" id="description" readonly>{{ $typepeti->description }}</textarea>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{ route('dashboard.typepeti.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
