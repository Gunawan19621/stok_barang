@extends('layouts.main')
@section('title', 'Peminjaman')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tabel Peminjaman</h1>
        <div class="mb-4">
            <p>Our Loan Tables are enhanced with the help of the DataTables plugin. This is a powerful tool that allows you
                to explore return data in a more interactive and efficient way</p>
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                <span class="text">+ Tambah peminjaman</span>
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Asset</th>
                                <th>Tgl Keluar</th>
                                <th>PJ Keluar</th>
                                <th>Asal Gudang</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Asset</th>
                                <th>Tgl Keluar</th>
                                <th>PJ Keluar</th>
                                <th>Asal Gudang</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $no_peminjaman = 1;
                            @endphp
                            @foreach ($peminjaman as $data)
                                <tr>
                                    <td>{{ $no_peminjaman++ }}</td>
                                    <td>{{ $data->asset->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->exit_at)->format('d-m-Y') }}</td>
                                    <td>{{ $data->exit_pic }}</td>
                                    <td>{{ $data->exit_warehouse }}</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal"
                                            data-target="#editDataModal{{ $data['id'] }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('hapusPeminjaman.destroy', $data->id) }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash text-danger mr-2" style="font-size: 20px"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Tambah data peminjaman -->
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
                    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="asset_id" class="col-form-label">Nama Asset:</label>
                            <select class="form-control" name="asset_id" type="text" id="asset_id">
                                <option disabled selected>Pilih Nama Asset</option>
                                @foreach ($asset as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <label for="exit_at" class="col-form-label">Tanggal:</label>
                            <input class="form-control" name="exit_at" type="date" id="exit_at"
                                value="{{ old('exit_at') }}" placeholder="Masukan Tanggal Keluar" required>

                            <label for="exit_pic" class="col-form-label">PJ Keluar:</label>
                            <input class="form-control" name="exit_pic" type="text" id="exit_pic"
                                value="{{ old('exit_pic') }}" placeholder="Masukan Nama PJ Keluar" pattern="[^0-9]+"
                                oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                            <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                            <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                                value="{{ old('exit_warehouse') }}" placeholder="Masukan Asal gudang keluarnya asset"
                                required>
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

    <!-- Modal Edit Asset-->
    @foreach ($peminjaman as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('peminjaman.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="asset_id" class="col-form-label">Nama Asset:</label>
                                <select class="form-control" name="asset_id" type="text" id="asset_id">
                                    <option disabled selected>Pilih Nama Asset</option>
                                    <option value="{{ $data->asset_id }}" selected>{{ $data->asset->name }}</option>
                                </select>
                                <label for="exit_at" class="col-form-label">Tanggal:</label>
                                <input class="form-control" name="exit_at" type="date" id="exit_at"
                                    value="{{ \Carbon\Carbon::parse($data->exit_at)->format('Y-m-d') }}"
                                    placeholder="Masukan Tanggal Keluar" required>

                                <label for="exit_pic" class="col-form-label">PJ Keluar:</label>
                                <input class="form-control" name="exit_pic" type="text" id="exit_pic"
                                    value="{{ $data->exit_pic }}" placeholder="Masukan Nama PJ Keluar" pattern="[^0-9]+"
                                    oninput="this.value=this.value.replace(/[0-9]/g,'');" required>

                                <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                                <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                                    value="{{ $data->exit_warehouse }}" placeholder="Masukan Nama PJ Keluar" required>
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
