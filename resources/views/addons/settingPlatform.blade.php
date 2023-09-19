@extends('layouts.main')
@section('title', 'Setting Platform')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tabel Barang</h1>
        <div class="mb-4">
            <p>DataTables is a third party plugin that is used to generate the demo table below. For more information about
                DataTables, please visit the</p>
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                <span class="text">+ Tambah data</span>
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Deskripsi Barang</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Deskripsi Barang</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @php
                                $no_product = 1;
                            @endphp --}}
                            @foreach ($product as $data)
                                <tr>
                                    <td>{{ $data->kode_barang }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->stok }}</td>
                                    <td>Rp {{ number_format($data['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal"
                                            data-target="#editDataModal{{ $data['id'] }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('hapusProduct.destroy', $data->id) }}">
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

    <!-- Modal Tambah Product-->
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
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                            <input class="form-control" name="nama_barang" type="text" id="nama_barang"
                                value="{{ old('nama_barang') }}" placeholder="Masukan Nama Barang" required>

                            <label for="stok" class="col-form-label">Stok:</label>
                            <input class="form-control" name="stok" type="text" id="stok"
                                value="{{ old('stok') }}" placeholder="Masukan Stok Barang"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>

                            <label for="harga" class="col-form-label">Harga:</label>
                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" name="harga" type="text" id="harga"
                                    value="{{ old('harga') }}" placeholder="Masukan Harga Barang"
                                    onkeypress="return hanyaAngka(event)"
                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 3, 'digitsOptional': false, 'placeholder': '0'"
                                    required>
                                @error('harga')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang" required>{{ old('jenis_barang') }}</textarea>
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

    <!-- Modal Edit Product-->
    @foreach ($product as $data)
        <div class="modal fade" id="editDataModal{{ $data['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                                <input class="form-control" name="nama_barang" type="text" id="nama_barang"
                                    value="{{ $data->nama_barang }}" placeholder="Masukan Nama Barang" required>

                                <label for="stok" class="col-form-label">Stok:</label>
                                <input class="form-control" name="stok" type="text" id="stok"
                                    value="{{ $data->stok }}" placeholder="Masukan Stok Barang"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>

                                <label for="harga" class="col-form-label">Harga:</label>
                                <div class="mb-3 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" name="harga" type="text" id="harga"
                                        value="{{ old('harga', str_replace('.', '', number_format($data['harga'], 0, ',', '.'))) }}"
                                        placeholder="Masukan Harga Barang" onkeypress="return hanyaAngka(event)"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 3, 'digitsOptional': false, 'placeholder': '0'"
                                        required>
                                    @error('harga')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang" required>{{ $data->deskripsi ?? old('deskripsi') }}</textarea>
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
