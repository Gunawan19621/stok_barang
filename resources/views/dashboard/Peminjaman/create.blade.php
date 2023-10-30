@extends('layouts.main')
@section('title', 'Tambah Peminjaman')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Tambah Peminjaman</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="peti_id" class="col-form-label">Pilih Detail Peti:</label>
                    <select class="form-control" name="peti_id" type="text" id="peti_id">
                        <option disabled selected>Pilih Detail Peti</option>
                        @foreach ($peti as $data_peti)
                            <option value="{{ $data_peti->id }}" data-warehouse-id="{{ $data_peti->warehouse_id }}">
                                {{ $data_peti->fix_lot }}
                            </option>
                        @endforeach
                    </select>
                    <label for="exit_at" class="col-form-label">Tanggal Peminjaman:</label>
                    <input class="form-control" name="exit_at" type="date" id="exit_at" value="{{ old('exit_at') }}"
                        placeholder="Masukan Tanggal Peminjaman" required>

                    <label for="est_pengembalian" class="col-form-label">Estimasi Tanggal Pengembalian:</label>
                    <input class="form-control" name="est_pengembalian" type="date" id="est_pengembalian"
                        value="{{ old('est_pengembalian') }}" placeholder="Masukan Estimasi Tanggal Peminjaman" required>

                    <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                    <select class="form-control" name="exit_warehouse" type="text" id="exit_warehouse">
                        <option disabled selected>Pilih Asal Gudang</option>
                        @foreach ($warehouse as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const petiSelect = document.getElementById('peti_id');
            const exitWarehouseSelect = document.getElementById('exit_warehouse');

            // Saat pilihan Detail Peti berubah
            petiSelect.addEventListener('change', function() {
                const selectedOption = petiSelect.options[petiSelect.selectedIndex];
                const warehouseId = selectedOption.getAttribute('data-warehouse-id');

                // Atur nilai pilihan Asal Gudang sesuai dengan data peti yang dipilih
                exitWarehouseSelect.value = warehouseId;
            });
        });
    </script>
@endsection
