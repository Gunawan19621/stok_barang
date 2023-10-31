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
                    <div>
                        <input class="form-control" hidden name="peti_id" type="text" id="peti_id"
                            value="{{ $peminjaman->peti_id }}" readonly>
                        <input class="form-control" value="{{ $peminjaman->peti->fix_lot }}" readonly>
                    </div>

                    <label for="exit_at" class="col-form-label">Tanggal Peminjaman:</label>
                    <input class="form-control" name="exit_at" type="date" id="exit_at"
                        value="{{ $peminjaman->exit_at }}" readonly>

                    <label for="est_pengembalian" class="col-form-label">Estimasi Tanggal Pengembalian:</label>
                    <input class="form-control" name="est_pengembalian" type="date" id="est_pengembalian"
                        value="{{ $peminjaman->est_pengembalian }}" readonly>

                    <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                    <div>
                        <input class="form-control" hidden name="exit_warehouse" type="text" id="exit_warehouse"
                            value="{{ $peminjaman->exit_warehouse }}" readonly>
                        <input class="form-control" value="{{ $peminjaman->warehouse->name }}" readonly>
                    </div>

                    <label for="enter_at" class="col-form-label">Tanggal Pengembalian:</label>
                    <input class="form-control" name="enter_at" type="date" id="enter_at"
                        value="{{ \Carbon\Carbon::parse($peminjaman->enter_at)->format('Y-m-d') }}" required>

                    <label for="enter_warehouse" class="col-form-label">Tujuan Pengembalian Gudang:</label>
                    <select class="form-control" name="enter_warehouse" type="text" id="enter_warehouse">
                        <option disabled selected>Pilih Tujuan Gudang</option>
                        @foreach ($warehouse as $data_warehouse)
                            <option value="{{ $data_warehouse->id }}"
                                @if ($data_warehouse->id == $peminjaman->enter_warehouse) selected
                                @else @endif>
                                {{ $data_warehouse->name }}</option>
                        @endforeach
                    </select>

                    <label for="kondisi_peti" class="col-form-label">Kondisi Peti:</label>
                    <input class="form-control" name="kondisi_peti" type="text" id="kondisi_peti"
                        value="{{ old('kondisi_peti', $peminjaman->kondisi_peti) }}" placeholder="Masukan kondisi peti"
                        pattern="[^0-9]+" oninput="this.value=this.value.replace(/[0-9]/g,'');" required>
                </div>
                {{--













                </div> --}}
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.pengembalian.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
