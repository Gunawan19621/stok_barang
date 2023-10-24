@extends('layouts.main')
@section('title', 'Edit Role')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Edit Data Role</h5>
                    </div>
                </div>
                <hr class="bordered">
                <form action="{{ route('dashboard.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama Hak Akses:</label>
                        <input class="form-control" name="name" type="text" id="name" value="{{ $role->name }}"
                            placeholder="Masukan Nama Hak Akses" required>

                        <label for="description" class="col-form-label">Deskripsi Hak Akses:</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Hak Akses" required>{{ $role->description }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('dashboard.role.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
