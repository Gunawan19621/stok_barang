@extends('layouts.main')
@section('title', 'Pengembalian')
@section('content')
    <div class="container-fluid">
        <!-- <h1 class="h3 mb-2 text-gray-800">Tabel Pengembalian</h1>  -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Asset</h6>
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
                                <th>Tgl Masuk</th>
                                <th>PJ Masuk</th>
                                <th>Tujuan Gudang</th>
                                <th>Status</th>
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
                                <th>Tgl Masuk</th>
                                <th>PJ Masuk</th>
                                <th>Tujuan Gudang</th>
                                <th>Status</th>
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
                                    <td>
                                        @if ($data->enter_at)
                                            {{ \Carbon\Carbon::parse($data->enter_at)->format('d-m-Y') }}
                                        @else
                                            <p class="text-center font-weight-bold">-</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->enter_pic)
                                            {{ $data->enter_pic }}
                                        @else
                                            <p class="text-center font-weight-bold">-</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->enter_warehouse)
                                            {{ $data->enter_warehouse }}
                                        @else
                                            <p class="text-center font-weight-bold">-</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->enter_warehouse === null)
                                            Not Return
                                        @else
                                            Return
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pengembalian.show', [$data->id]) }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
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

    <!-- Modal Edit Asset-->
    {{-- @foreach ($peminjaman as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Tanggal Pengembalian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengembalian.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="asset_id" class="col-form-label">Nama Asset:</label>
                                <input class="form-control" name="asset_id" type="text" id="asset_id"
                                    value="{{ $data->asset->name }}" readonly required>

                                <label for="exit_at" class="col-form-label">Tanggal Peminjaman:</label>
                                <input class="form-control" name="exit_at" type="date" id="exit_at"
                                    value="{{ \Carbon\Carbon::parse($data->exit_at)->format('Y-m-d') }}"
                                    placeholder="Masukan Tanggal Keluar" readonly required>

                                <label for="exit_pic" class="col-form-label">PJ Keluar:</label>
                                <input class="form-control" name="exit_pic" type="text" id="exit_pic"
                                    value="{{ $data->exit_pic }}" placeholder="Masukan Nama PJ Keluar" readonly required>

                                <label for="exit_warehouse" class="col-form-label">Asal Gudang :</label>
                                <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                                    value="{{ $data->exit_warehouse }}" placeholder="Masukan Nama PJ Keluar" readonly
                                    required>

                                <label for="enter_at" class="col-form-label">Tanggal Pengembalian:</label>
                                <input class="form-control" name="enter_at" type="date" id="enter_at"
                                    value="{{ old('enter_at') }}" placeholder="Masukan Tanggal Pengembalian" required>

                                <label for="enter_pic" class="col-form-label">PJ Pengembalian:</label>
                                <input class="form-control" name="enter_pic" type="text" id="enter_pic"
                                    value="{{ old('enter_pic') }}" placeholder="Masukan Nama PJ Pengembalian" required>

                                <label for="enter_warehouse" class="col-form-label">Tujuan Pengembalian GUdang:</label>
                                <input class="form-control" name="enter_warehouse" type="text" id="enter_warehouse"
                                    value="{{ old('enter_warehouse') }}" placeholder="Masukan tujuan pengembalian"
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
    @endforeach --}}
@endsection
