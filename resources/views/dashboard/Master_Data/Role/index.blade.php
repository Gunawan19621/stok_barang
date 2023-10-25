@extends('layouts.main')
@section('title', 'Role')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data Role</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                            data-target="#tambahDataModal">
                            <span class="text">Tambah Data Role</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama Role</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $norole = 1;
                            @endphp
                            @foreach ($role as $data_role)
                                <tr>
                                    <td class="text-center">{{ $norole++ }}</td>
                                    <td>{{ $data_role->name }}</td>
                                    <td>{{ $data_role->description }}</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal"
                                            data-target="#editDataModal{{ $data_role->id }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <form action="{{ route('dashboard.role.destroy', $data_role->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                style="border: none; background: none; cursor: pointer;">
                                                <i class="fa fa-trash text-danger" style="font-size: 20px"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Data Modal-->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Hak Akses:</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ old('name') }}" placeholder="Masukan Nama Hak Akses" required>

                                <label for="description" class="col-form-label">Deskripsi Hak Akses:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Hak Akses" required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($role as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Asset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.role.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Hak Akses:</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ $data->name }}" placeholder="Masukan Nama Hak Akses" required>

                                <label for="description" class="col-form-label">Deskripsi Hak Akses:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Hak Akses"
                                    required>{{ $data->description }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
