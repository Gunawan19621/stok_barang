@extends('layouts.main')
@section('title', 'Edit Peminjaman')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Edit Peminjaman</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.peminjaman.update', $peminjaman->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="peti_id" class="col-form-label">Pilih Detail Peti:</label>
                    <select class="form-control" name="peti_id" id="peti_id">
                        <option disabled selected>Pilih Detail Peti</option>
                        @foreach ($peti as $data_peti)
                            <option value="{{ $data_peti->id }}" data-warehouse-id="{{ $data_peti->warehouse_id }}"
                                {{ $data_peti->id == $peminjaman->peti_id ? 'selected' : '' }}>
                                {{ $data_peti->fix_lot }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exit_at" class="col-form-label">Tanggal Peminjaman:</label>
                    <input class="form-control" name="exit_at" type="date" id="exit_at"
                        value="{{ $peminjaman->exit_at }}" required>
                </div>

                <div class="form-group">
                    <label for="est_pengembalian" class="col-form-label">Estimasi Tanggal Pengembalian:</label>
                    <input class="form-control" name="est_pengembalian" type="date" id="est_pengembalian"
                        value="{{ $peminjaman->est_pengembalian }}" required>
                </div>

                <div class="form-group">
                    <label for="exit_warehouse" class="col-form-label">Asal Gudang:</label>
                    <select class="form-control" name="exit_warehouse" id="exit_warehouse">
                        <option disabled selected>Pilih Asal Gudang</option>
                        @foreach ($warehouse as $data)
                            <option value="{{ $data->id }}"
                                {{ $data->id == $peminjaman->exit_warehouse ? 'selected' : '' }}>
                                {{ $data->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

                // Atur indeks pilihan Asal Gudang sesuai dengan data peti yang dipilih
                if (warehouseId) {
                    exitWarehouseSelect.selectedIndex = [...exitWarehouseSelect.options].findIndex(option =>
                        option.value === warehouseId);
                }
            });
        });
    </script>
@endsection
