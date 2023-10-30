@extends('layouts.main')
@section('title', 'Setting Platform')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Data Asset</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                        <span class="text">+ Tambah data</span>
                    </a>
                    <a href="{{ route('dashboard.assetcetakpdf.cetakpdf') }}" class="btn btn-success btn-icon-split ml-auto"
                        target="_blank">
                        <span class="text">Cetak PDF</span>
                    </a>
                    <a href="{{ route('dashboard.assetexport.export') }}" class="btn btn-info btn-icon-split ml-auto"
                        target="_blank">
                        <span class="text">Cetak Exel</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Seri</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Gudang</th>
                            <th>Tanggal</th>
                            <th>Jumlah QR Print</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset as $data)
                            <tr>
                                <td>{{ $data->seri }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->warehouse->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->date)->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    {!! QrCode::size(80)->generate(route('dashboard.asset.show', $data->id)) !!}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.asset.show', $data->id) }}">
                                        <i class="fa fa-eye mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#editDataModal{{ $data->id }}">
                                        <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <form action="{{ route('dashboard.asset.destroy', $data->id) }}" method="POST"
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
                    <form action="{{ route('dashboard.asset.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nama Asset:</label>
                            <input class="form-control" name="name" type="text" id="name"
                                value="{{ old('name') }}" placeholder="Masukan Nama Asset" required>

                            <label for="description" class="col-form-label">Deskripsi Asset:</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Asset" required>{{ old('description') }}</textarea>

                            <label for="warehouse_id" class="col-form-label">Gudang:</label>
                            <select class="form-control" name="warehouse_id" type="text" id="warehouse_id">
                                <option disabled selected>Pilih Asal Gudang</option>
                                @foreach ($warehouse as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>

                            <label for="date" class="col-form-label">Tanggal:</label>
                            <input class="form-control" name="date" type="date" id="date"
                                value="{{ old('date') }}" placeholder="Masukan Tanggal Asset" required>
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
    @foreach ($asset as $data)
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
                        <form action="{{ route('dashboard.asset.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Asset:</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ $data->name }}" placeholder="Masukan Nama Asset" required>

                                <label for="description" class="col-form-label">Deskripsi Asset:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Asset" required>{{ $data->description }}</textarea>

                                <label for="date" class="col-form-label">Tanggal:</label>
                                <input class="form-control" name="date" type="date" id="date"
                                    value="{{ \Carbon\Carbon::parse($data->date)->format('Y-m-d') }}"
                                    placeholder="Masukan Tanggal Asset" required>

                                <label for="warehouse_id" class="col-form-label">Gudang:</label>
                                <select class="form-control" name="warehouse_id" id="warehouse_id">
                                    <option disabled selected>Pilih Asal Gudang</option>
                                    @foreach ($warehouse as $data_warehouse)
                                        <option value="{{ $data_warehouse->id }}"
                                            @if ($data_warehouse->id == $data->warehouse_id) selected
                                                @else @endif>
                                            {{ $data_warehouse->name }}</option>
                                    @endforeach
                                </select>

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

    <!-- Modal Print QR Asset-->
    {{-- @foreach ($asset as $data)
        <div class="modal fade" id="printQRModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Print QR Asset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.asset.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Asset:</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    value="{{ $data->name }}" placeholder="Masukan Nama Asset" required>

                                <label for="description" class="col-form-label">Deskripsi Asset:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Masukkan Deskripsi Asset" required>{{ $data->description }}</textarea>

                                <label for="qr_count" class="col-form-label">QR_Count:</label>
                                <input class="form-control" name="qr_count" type="text" id="qr_count"
                                    value="{{ $data->qr_count }}" placeholder="Masukan Kode QR"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>

                                <label for="date" class="col-form-label">Tanggal:</label>
                                <input class="form-control" name="date" type="date" id="date"
                                    value="{{ \Carbon\Carbon::parse($data->date)->format('Y-m-d') }}"
                                    placeholder="Masukan Tanggal Asset" required>

                                <label for="warehouse_id" class="col-form-label">Gudang:</label>
                                <select class="form-control" name="warehouse_id" id="warehouse_id">
                                    <option disabled selected>Pilih Asal Gudang</option>
                                    @foreach ($warehouse as $data_warehouse)
                                        <option value="{{ $data_warehouse->id }}"
                                            @if ($data_warehouse->id == $data->warehouse_id) selected
                                                @else @endif>
                                            {{ $data_warehouse->name }}</option>
                                    @endforeach
                                </select>

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
