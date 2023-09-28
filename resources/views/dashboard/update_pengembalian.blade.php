@extends('layouts.main')
@section('title', 'Update Data Pengembalian')
@section('content')
    <div class="card m-3">
        <div class="card-body m-2">
            <h3>Data Pengembalian</h3>
            <hr class="border">
            <form action="{{ route('pengembalian.update', [$peminjaman->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <!-- Input tersembunyi untuk menyimpan ID aset -->
                    <input type="hidden" name="asset_id" value="{{ $peminjaman->asset_id }}">

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
                    <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                        value="{{ $peminjaman->exit_warehouse }}" placeholder="Masukan Nama PJ Keluar" readonly required>

                    <label for="enter_at" class="col-form-label">Tanggal Pengembalian:</label>
                    {{-- <input class="form-control" name="enter_at" type="date" id="enter_at"
                        value="{{ old('enter_at', $peminjaman->enter_at) }}" placeholder="Masukan Tanggal Pengembalian"
                        required> --}}
                    <input class="form-control" name="enter_at" type="date" id="enter_at"
                        value="{{ \Carbon\Carbon::parse($peminjaman->enter_at)->format('Y-m-d') }}"
                        placeholder="Masukan Tanggal Asset" required>

                    <label for="enter_pic" class="col-form-label">PJ Pengembalian:</label>
                    <input class="form-control" name="enter_pic" type="text" id="enter_pic"
                        value="{{ old('enter_pic', $peminjaman->enter_pic) }}" placeholder="Masukan Nama PJ Pengembalian"
                        pattern="[^0-9]+" oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="enter_warehouse" class="col-form-label">Tujuan Pengembalian Gudang:</label>
                    <input class="form-control" name="enter_warehouse" type="text" id="enter_warehouse"
                        value="{{ old('enter_warehouse', $peminjaman->enter_warehouse) }}"
                        placeholder="Masukan tujuan pengembalian" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="window.location.href = '{{ route('pengembalian.index') }}'">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
