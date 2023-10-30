@extends('layouts.main')
@section('title', 'Update Data Pengembalian')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Update Pengembalian</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.pengembalian.update', [$peminjaman->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                {{--
                    <!-- Elemen input readonly untuk menampilkan nama aset -->
                    <label for="asset_name" class="col-form-label">Nama Asset:</label>
                    <input class="form-control" name="asset_name" type="text" id="asset_name"
                        value="{{ $peminjaman->asset->name }}" readonly required>

                    <label for="exit_at" class="col-form-label">Tanggal Peminjaman:</label>
                    <input class="form-control" name="exit_at" type="date" id="exit_at"
                        value="{{ \Carbon\Carbon::parse($peminjaman->exit_at)->format('Y-m-d') }}"
                        placeholder="Masukan Tanggal Keluar" readonly required>

                    <label for="exit_pic" class="col-form-label">PJ Keluar:</label>
                    <input class="form-control" name="exit_pic" type="text" id="exit_pic"
                        value="{{ $peminjaman->exit_pic }}" placeholder="Masukan Nama PJ Keluar" readonly required>

                    <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                    <input type="hidden" name="exit_warehouse" id="exit_warehouse"
                        value="{{ $peminjaman->exit_warehouse }}">
                    <input class="form-control" type="text" value="{{ $peminjaman->warehouse->name }}" readonly required>

                    <label for="enter_at" class="col-form-label">Tanggal Pengembalian:</label>
                    <input class="form-control" name="enter_at" type="date" id="enter_at"
                        value="{{ \Carbon\Carbon::parse($peminjaman->enter_at)->format('Y-m-d') }}"
                        placeholder="Masukan Tanggal Asset" required>

                    <label for="enter_pic" class="col-form-label">PJ Pengembalian:</label>
                    <input class="form-control" name="enter_pic" type="text" id="enter_pic"
                        value="{{ old('enter_pic', $peminjaman->enter_pic) }}" placeholder="Masukan Nama PJ Pengembalian"
                        pattern="[^0-9]+" oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="enter_warehouse" class="col-form-label">Tujuan Pengembalian Gudang:</label>
                    <select class="form-control" name="enter_warehouse" type="text" id="enter_warehouse">
                        <option disabled selected>Pilih Nama Asset</option>
                        @foreach ($warehouse as $data_warehouse)
                            <option value="{{ $data_warehouse->id }}"
                                @if ($data_warehouse->id == $peminjaman->enter_warehouse) selected
                                @else @endif>
                                {{ $data_warehouse->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
