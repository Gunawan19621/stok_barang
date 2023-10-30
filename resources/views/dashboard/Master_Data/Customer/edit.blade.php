@extends('layouts.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Edit Customer</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.customer.update', [$customer->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama Customer:</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ $customer->name }}"
                        placeholder="Masukan nama customer" required>

                    <label for="code_customer" class="col-form-label">Kode Customer:</label>
                    <input class="form-control" name="code_customer" type="text" id="code_customer"
                        value="{{ $customer->code_customer }}" placeholder="Masukan kode customer" required>

                    <label for="lot_no" class="col-form-label">Lot Number:</label>
                    <input class="form-control" name="lot_no" type="text" id="lot_no" value="{{ $customer->lot_no }}"
                        placeholder="Masukan lot number" required>

                    <label for="nip" class="col-form-label">NIP Customer:</label>
                    <input class="form-control" name="nip" type="text" id="nip" value="{{ $customer->nip }}"
                        placeholder="Masukan NIP customer" required>

                    <label for="no_hp" class="col-form-label">No. HP Customer:</label>
                    <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{ $customer->no_hp }}"
                        placeholder="Masukan Nomor Handphone customer" required>

                    <label for="tgl_lahir" class="col-form-label">Tanggal Lahir Customer:</label>
                    <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir"
                        value="{{ $customer->tgl_lahir }}" required>

                    <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin Customer:</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option disabled>Pilih Jenis Kelamin Customer</option>
                        <option value="Laki-Laki" {{ $customer->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="Perempuan" {{ $customer->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>

                    <label for="agama" class="col-form-label">Agama Customer:</label>
                    <select class="form-control" name="agama" id="agama" required>
                        <option disabled selected>Pilih Agama Customer</option>
                        <option value="Islam" {{ $customer->agama === 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $customer->agama === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ $customer->agama === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ $customer->agama === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ $customer->agama === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ $customer->agama === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        <option value="Lainnya" {{ $customer->agama === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>

                    <label for="address" class="col-form-label">Alamat Customer:</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat customer" required>{{ $customer->address }}</textarea>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.customer.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
