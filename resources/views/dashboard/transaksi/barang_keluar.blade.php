@extends('layouts.main')
@section('title', 'Barang Keluar')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tabel Barang Keluar</h1>
        <div class="mb-4">
            <p>Our Outgoing Item Tables are enhanced with the help of the DataTables plugin. This is a powerful tool that
                allows you to explore outgoing data in a more interactive and efficient way.</p>
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                <span class="text">+ Tambah data</span>
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data Barang Keluar</h5>
                    </div>
                    {{-- <div class="col-6 text-right">
                        <a href="{{ route('assetcetakpdf.cetakpdf') }}" class="btn btn-success btn-icon-split ml-auto"
                            target="_blank">
                            <span class="text">Cetak PDF</span>
                        </a>
                        <a href="{{ route('assetexport.export') }}" class="btn btn-info btn-icon-split ml-auto"
                            target="_blank">
                            <span class="text">Cetak Exel</span>
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Tgl Keluar</th>
                                <th>Penerima</th>
                                <th>Asal Gudang</th>
                                <th>Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Tgl Keluar</th>
                                <th>Penerima</th>
                                <th>Asal Gudang</th>
                                <th>Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Bkeluar as $data)
                                <tr>
                                    <td>{{ $data->asset->name }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_keluar)->format('d-m-Y') }}</td>
                                    <td>{{ $data->penerima_barang }}</td>
                                    <td>{{ $data->exit_warehouse }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal"
                                            data-target="#editDataModal{{ $data['id'] }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('hapusBarangK.destroy', $data->id) }}"
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
                    {{-- <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data"> --}}
                    <form action="{{ route('barangKeluar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="asset_id" class="col-form-label">Nama Barang:</label>
                            <select class="form-control" name="asset_id" type="text" id="asset_id">
                                <option disabled selected>Pilih Nama Barang</option>
                                @foreach ($asset as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>

                            <label for="jumlah" class="col-form-label">Jumlah Barang:</label>
                            <input class="form-control" name="jumlah" type="number" id="jumlah"
                                value="{{ old('jumlah') }}" placeholder="Masukkan Jumlah Barang" required>

                            <label for="tanggal_keluar" class="col-form-label">Tgl Keluar:</label>
                            <input class="form-control" name="tanggal_keluar" type="date" id="tanggal_keluar"
                                value="{{ old('tanggal_keluar') }}" placeholder="Masukkan Tgl Keluar Barang" required>

                            <label for="penerima_barang" class="col-form-label">Pererima:</label>
                            <input class="form-control" name="penerima_barang" type="text" id="penerima_barang"
                                value="{{ old('penerima_barang') }}" placeholder="Masukkan Penerima Barang" required>

                            <label for="exit_warehouse" class="col-form-label">Asal Gudang:</label>
                            <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                                value="{{ old('exit_warehouse') }}" placeholder="Masukan Asal Gudang Barang" required>

                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan Barang" required>{{ old('keterangan') }}</textarea>
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
    @foreach ($Bkeluar as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="asset_id" class="col-form-label">Nama Barang:</label>
                                <select class="form-control" name="asset_id" type="text" id="asset_id">
                                    <option disabled selected>Pilih Nama Barang</option>
                                    @foreach ($asset as $data_asset)
                                        <option value="{{ $data->id }}"
                                            @if ($data_asset->id == $data->asset_id) selected
                                            @else @endif>
                                            {{ $data_asset->name }}</option>
                                    @endforeach
                                </select>

                                <label for="jumlah" class="col-form-label">Jumlah Barang:</label>
                                <input class="form-control" name="jumlah" type="number" id="jumlah"
                                    value="{{ $data->jumlah }}" placeholder="Masukkan Jumlah Barang" required>

                                <label for="tanggal_keluar" class="col-form-label">Tgl Keluar:</label>
                                <input class="form-control" name="tanggal_keluar" type="date" id="tanggal_keluar"
                                    value="{{ \Carbon\Carbon::parse($data->tanggal_keluar)->format('Y-m-d') }}"
                                    placeholder="Masukkan Tgl Keluar Barang" required>

                                <label for="penerima_barang" class="col-form-label">Pererima:</label>
                                <input class="form-control" name="penerima_barang" type="text" id="penerima_barang"
                                    value="{{ $data->penerima_barang }}" placeholder="Masukkan Penerima Barang" required>

                                <label for="exit_warehouse" class="col-form-label">Asal Gudang:</label>
                                <input class="form-control" name="exit_warehouse" type="text" id="exit_warehouse"
                                    value="{{ $data->exit_warehouse }}" placeholder="Masukan Asal Gudang Barang"
                                    required>

                                <label for="keterangan" class="col-form-label">Keterangan:</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan Barang" required>{{ $data->keterangan }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Asset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('asset.update', $data->id) }}" method="POST"
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
            </div> --}}
        </div>
    @endforeach
@endsection
