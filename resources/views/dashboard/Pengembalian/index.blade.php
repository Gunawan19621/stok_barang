@extends('layouts.main')
@section('title', 'Pengembalian')
@section('content')
    <div class="container-fluid">
        <!-- <h1 class="h3 mb-2 text-gray-800">Tabel Pengembalian</h1>  -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengembalian</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Asset</th>
                                <th>Tgl Peinjaman</th>
                                <th>PJ Peinjaman</th>
                                <th>Asal Gudang</th>
                                <th>Tgl Pengembalian</th>
                                <th>PJ Pengembalian</th>
                                <th>Tujuan Gudang</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
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
                                    <td>{{ $data->warehouse->name }}</td>
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
                                            {{ $data->warehouse->name }}
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
                                        <a href="{{ route('dashboard.pengembalian.edit', [$data->id]) }}">
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
@endsection
