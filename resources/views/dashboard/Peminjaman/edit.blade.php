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
                    <label for="asset_id" class="col-form-label">Nama Asset:</label>
                    <select class="form-control" name="asset_id" type="text" id="asset_id">
                        <option disabled selected>Pilih Nama Asset</option>
                        @foreach ($asset as $data_asset)
                            <option value="{{ $data_asset->id }}"
                                @if ($data_asset->id == $peminjaman->id) selected
                                @else @endif>
                                {{ $data_asset->name }}</option>
                        @endforeach
                    </select>
                    <label for="exit_at" class="col-form-label">Tanggal:</label>
                    <input class="form-control" name="exit_at" type="date" id="exit_at"
                        value="{{ \Carbon\Carbon::parse($peminjaman->exit_at)->format('Y-m-d') }}"
                        placeholder="Masukan Tanggal Keluar" required>

                    <label for="exit_pic" class="col-form-label">PJ Keluar:</label>
                    <input class="form-control" name="exit_pic" type="text" id="exit_pic"
                        value="{{ $peminjaman->exit_pic }}" placeholder="Masukan Nama PJ Keluar" pattern="[^0-9]+"
                        oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                    <select class="form-control" name="exit_warehouse" type="text" id="exit_warehouse">
                        <option disabled selected>Pilih Nama Asset</option>
                        @foreach ($warehouse as $data_warehouse)
                            <option value="{{ $data_warehouse->id }}"
                                @if ($data_warehouse->id == $peminjaman->id) selected
                                @else @endif>
                                {{ $data_warehouse->name }}</option>
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
@endsection
