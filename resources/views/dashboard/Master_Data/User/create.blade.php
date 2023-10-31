@extends('layouts.main')
@section('title', 'Tambah User')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Tambah User</h5>
                </div>
            </div>
        </div>


        @include('layouts.components.alert-prompt')


        <div class="card-body">
            <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="username" class="col-form-label">Username:</label>
                    <input class="form-control" name="username" type="text" id="username" value="{{ old('username') }}"
                        placeholder="Masukan Username user" required>

                    <label for="fullname" class="col-form-label">Nama Lengkap:</label>
                    <input class="form-control" name="fullname" type="text" id="fullname" value="{{ old('fullname') }}"
                        placeholder="Masukan Nama Lengkap user" pattern="[^0-9]+"
                        oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="email" class="col-form-label">Email:</label>
                    <input class="form-control" name="email" type="email" id="email" value="{{ old('email') }}"
                        placeholder="Masukan email user" required>

                    <label for="divisi" class="col-form-label">Divisi:</label>
                    <input class="form-control" name="divisi" type="text" id="divisi" value="{{ old('divisi') }}"
                        placeholder="Masukan Divisi user" pattern="[^0-9]+"
                        oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="role_id" class="col-form-label">Hak Akses:</label>
                    <select class="form-control" name="role_id" id="role_id" required>
                        <option disabled selected>Pilih Hak Akses User</option>
                        @foreach ($role as $dt_role)
                            <option value="{{ $dt_role->id }}">{{ $dt_role->name }}</option>
                        @endforeach
                    </select>

                    <label for="warehouse_id" class="col-form-label">Ditugaskan:</label>
                    <select class="form-control" name="warehouse_id" id="warehouse_id" required>
                        <option disabled selected>Pilih Hak Akses User</option>
                        @foreach ($warehouse as $dt_warehouse)
                            <option value="{{ $dt_warehouse->id }}">{{ $dt_warehouse->name }}</option>
                        @endforeach
                    </select>

                    <label for="password" class="col-form-label">Password:</label>
                    <input class="form-control" name="password" type="text" id="password" value="{{ old('password') }}"
                        placeholder="Masukan password user" required>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('dashboard.user.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
