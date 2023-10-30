@extends('layouts.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Tambah Customer</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama Customer:</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ old('name') }}"
                        placeholder="Masukan nama customer" required>

                    <label for="code_customer" class="col-form-label">Kode Customer:</label>
                    <input class="form-control" name="code_customer" type="text" id="code_customer"
                        value="{{ old('code_customer') }}" placeholder="Masukan kode customer" required>

                    <label for="lot_no" class="col-form-label">Lot Number:</label>
                    <input class="form-control" name="lot_no" type="text" id="lot_no" value="{{ old('lot_no') }}"
                        placeholder="Masukan lot number" required>

                    <label for="nip" class="col-form-label">NIP Customer:</label>
                    <input class="form-control" name="nip" type="text" id="nip" value="{{ old('nip') }}"
                        placeholder="Masukan NIP customer" required>

                    <label for="no_hp" class="col-form-label">No. HP Customer:</label>
                    <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{ old('no_hp') }}"
                        placeholder="Masukan Nomor Handphone customer" required>

                    <label for="tgl_lahir" class="col-form-label">Tanggal Lahir Customer:</label>
                    <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir"
                        value="{{ old('tgl_lahir') }}" required>

                    <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin Customer:</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option disabled selected>Pilih Jenis Kelamin Customer</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <label for="agama" class="col-form-label">Agama Customer:</label>
                    <select class="form-control" name="agama" id="agama" required>
                        <option disabled selected>Pilih Agama Customer</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>

                    <label for="address" class="col-form-label">Alamat Customer:</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat customer" required></textarea>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.customer.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
