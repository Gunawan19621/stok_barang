@extends('layouts.main')
@section('title', 'Manajemen User')
@section('content')
    {{-- <h1>Halaman Manajement User</h1> --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data User</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                            data-target="#tambahDataModal">
                            <span class="text">+ Tambah data</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th>Ditugaskan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th>Ditugaskan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $noUser = 1;
                            @endphp
                            @forelse ($user as $data)
                                <tr>
                                    <td class="text-center">{{ $noUser++ }}</td>
                                    <td>{{ $data->fullname }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ isset($data->no_hp) ? $data->no_hp : '-' }}</td>
                                    <td>{{ isset($data->address) ? $data->address : '-' }}</td>
                                    <td>{{ $data->warehouse->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.show', [$data->id]) }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('hapusUser.destroy', $data->id) }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash text-danger mr-2" style="font-size: 20px"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <p>Data Kosong</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Asset-->
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
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username:</label>
                            <input class="form-control" name="username" type="text" id="username"
                                value="{{ old('username') }}" placeholder="Masukan Username user" required>

                            <label for="fullname" class="col-form-label">Nama Lengkap:</label>
                            <input class="form-control" name="fullname" type="text" id="fullname"
                                value="{{ old('fullname') }}" placeholder="Masukan Nama Lengkap user" pattern="[^0-9]+"
                                oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                            <label for="email" class="col-form-label">Email:</label>
                            <input class="form-control" name="email" type="email" id="email"
                                value="{{ old('email') }}" placeholder="Masukan email user" required>

                            <label for="divisi" class="col-form-label">Divisi:</label>
                            <input class="form-control" name="divisi" type="text" id="divisi"
                                value="{{ old('divisi') }}" placeholder="Masukan Divisi user" pattern="[^0-9]+"
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
                            <input class="form-control" name="password" type="text" id="password"
                                value="{{ old('password') }}" placeholder="Masukan password user" required>
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
@endsection
