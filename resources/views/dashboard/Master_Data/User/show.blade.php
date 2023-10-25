@extends('layouts.main')
@section('title', 'Detail User')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Detail User</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="username" class="col-form-label">Username:</label>
                <input class="form-control" name="username" type="text" id="username" value="{{ $user->username }}"
                    readonly>

                <label for="fullname" class="col-form-label">Nama Lengkap:</label>
                <input class="form-control" name="fullname" type="text" id="fullname" value="{{ $user->fullname }}"
                    readonly>

                <label for="nip" class="col-form-label">Nip:</label>
                <input class="form-control" name="nip" type="text" id="nip" value="{{ $user->nip }}"
                    readonly>

                <label for="email" class="col-form-label">Email:</label>
                <input class="form-control" name="email" type="email" id="email" value="{{ $user->email }}"
                    readonly>

                <label for="no_hp" class="col-form-label">No Handphone:</label>
                <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{ $user->no_hp }}"
                    readonly>

                <label for="divisi" class="col-form-label">Divisi:</label>
                <input class="form-control" name="divisi" type="text" id="divisi" value="{{ $user->divisi }}"
                    readonly>

                <label for="tgl_lahir" class="col-form-label">Tanggal Lahir:</label>
                <input class="form-control" name="tgl_lahir" type="text" id="tgl_lahir" value="{{ $user->tgl_lahir }}"
                    readonly>

                <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin:</label>
                <input class="form-control" name="jenis_kelamin" type="text" id="jenis_kelamin"
                    value="{{ $user->jenis_kelamin }}" readonly>

                <label for="agama" class="col-form-label">Agama:</label>
                <input class="form-control" name="agama" type="text" id="agama" value="{{ $user->agama }}"
                    readonly>

                <label for="role_id" class="col-form-label">Hak Akses:</label>
                <select class="form-control" name="role_id" id="role_id" readonly disabled>
                    @foreach ($role as $data)
                        <option value="{{ $data->id }}" {{ $data->id == $user->role_id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>

                <label for="warehouse_id" class="col-form-label">Ditugaskan di gudang:</label>
                <select class="form-control" name="warehouse_id" id="warehouse_id" readonly disabled>
                    @foreach ($warehouse as $data)
                        <option value="{{ $data->id }}" {{ $data->id == $user->warehouse_id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>

                <label for="address" class="col-form-label">Alamat:</label>
                <input class="form-control" name="address" type="text" id="address" value="{{ $user->address }}"
                    readonly>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="{{ route('dashboard.user.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
