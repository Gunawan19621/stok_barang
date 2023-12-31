@extends('layouts.main')
@section('title', 'Warehouse')
@section('content')

    @include('layouts.components.alert-prompt')
    @if (auth()->user()->role_id == 1)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data Gudang</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                            data-target="#tambahDataModal">
                            <span class="text">Tambah Data Gudang</span>
                        </a>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No.</th>
                                <th>Nama Gudang</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nowarehouses = 1;
                            @endphp
                            @foreach ($warehouses as $data)
                                <tr>
                                    <td class="text-center" style="width: 50px;">{{ $nowarehouses++ }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal"
                                            data-target="#editDataModal{{ $data['id'] }}">
                                            <i class="fa fa-edit" style="font-size: 20px"></i>
                                        </a>
                                        <form action="{{ route('dashboard.warehouse.destroy', $data->id) }}" method="POST"
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
    @else
        @include('pages.user.Master_Data.Warehouse.index')
    @endif

    <!-- Modal Tambah-->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gudang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.warehouse.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nama:</label>
                            <input class="form-control" name="name" type="text" id="name"
                                value="{{ old('name') }}" placeholder="Masukan Nama Gudang" required>

                            <label for="description" class="col-form-label">Deskripsi:</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Gudang" required>{{ old('description') }}</textarea>

                            <label for="address" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Masukkan Alamat Gudang" required>{{ old('address') }}</textarea>
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

    <!-- Modal Edit Data-->
    @foreach ($warehouses as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Gudang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.warehouse.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama:</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ $data->name }}" placeholder="Masukan Nama Gudang" required>

                                <label for="description" class="col-form-label">Deskripsi:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Gudang" required>{{ $data->description }}</textarea>

                                <label for="address" class="col-form-label">Alamat:</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Masukkan Alamat Gudang" required>{{ $data->address }}</textarea>
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
