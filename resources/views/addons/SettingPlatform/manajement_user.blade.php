@extends('layouts.main')
@section('title', 'Manajemen User')
@section('content')
    {{-- <h1>Halaman Manajement User</h1> --}}
    <div class="container-fluid">
        <!-- <h1 class="h3 mb-2 text-gray-800">Tabel User</h1>
        <div class="mb-4">
            <p>Our User Tables are enhanced with the help of the DataTables plugin. This is a powerful tool that allows you
                to explore return data in a more interactive and efficient way</p>
            {{-- <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                <span class="text">+ Tambah data</span> --}}
            </a>
        </div> -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data User</h5>
                    </div>
                    <div class="col-6 text-right">
                    {{--<a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#tambahDataModal">
                        <span class="text">+ Tambah data</span>
                    </a>--}}
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
                                    <td>{{ $noUser++ }}</td>
                                    <td>{{ $data->fullname }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->no_hp }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->warehouse->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.show', [$data->id]) }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        {{-- <a href="{{ route('hapusUser.destroy', $data->id) }}">
                                            <i class="fa fa-trash text-danger mr-2" style="font-size: 20px"></i>
                                        </a> --}}
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
@endsection
