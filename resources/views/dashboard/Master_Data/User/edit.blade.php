@extends('layouts.main')
@section('title', 'Update Data User')
@section('content')
    @include('layouts.components.alert-prompt')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Edit User</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.user.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="username" class="col-form-label">Username:</label>
                    <input class="form-control" name="username" type="text" id="username" value="{{ $user->username }}"
                        placeholder="Masukan Username user" required>

                    <label for="fullname" class="col-form-label">Nama Lengkap:</label>
                    <input class="form-control" name="fullname" type="text" id="fullname" value="{{ $user->fullname }}"
                        placeholder="Masukan Nama Lengkap user" pattern="[^0-9]+"
                        oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="email" class="col-form-label">Email:</label>
                    <input class="form-control" name="email" type="email" id="email" value="{{ $user->email }}"
                        placeholder="Masukan email user" required>

                    <label for="divisi" class="col-form-label">Divisi:</label>
                    <input class="form-control" name="divisi" type="text" id="divisi" value="{{ $user->divisi }}"
                        placeholder="Masukan Divisi user" pattern="[^0-9]+"
                        oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                    <label for="role_id" class="col-form-label">Hak Akses:</label>
                    <select class="form-control" name="role_id" type="text" id="role_id">
                        <option disabled selected>Pilih Hak Akses</option>
                        @foreach ($role as $data)
                            <option value="{{ $data->id }}"
                                @if ($data->id == $user->role_id) selected
                                @else @endif>
                                {{ $data->name }}</option>
                        @endforeach
                    </select>

                    <label for="warehouse_id" class="col-form-label">Ditugaskan digudnag:</label>
                    <select class="form-control" name="warehouse_id" type="text" id="warehouse_id">
                        <option disabled selected>Pilih DItugaskan</option>
                        @foreach ($warehouse as $data)
                            <option value="{{ $data->id }}"
                                @if ($data->id == $user->warehouse_id) selected
                                @else @endif>
                                {{ $data->name }}</option>
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
