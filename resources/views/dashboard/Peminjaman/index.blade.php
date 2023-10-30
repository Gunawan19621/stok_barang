@extends('layouts.main')
@section('title', 'Peminjaman')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Data Peminjaman</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('dashboard.peminjaman.create') }}" class="btn btn-success btn-icon-split">
                        <span class="text">Tambah Peminjaman</span>
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
                            <th class="text-center">No</th>
                            <th>Kode Peti</th>
                            <th>Nama Customer</th>
                            <th>Tgl Peminjaman</th>
                            <th>PJ Keluar</th>
                            <th>Asal Gudang</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no_peminjaman = 1;
                        @endphp
                        @forelse ($peminjaman as $data_peminjaman)
                            <tr>
                                <td>{{ $no_peminjaman++ }}</td>
                                <td>{{ $data_peminjaman->peti->customer->code_customer }} -
                                    {{ $data_peminjaman->peti->tipe_peti->type }}</td>
                                <td>{{ $data_peminjaman->peti->customer->name }}</td>
                                <td>{{ $data_peminjaman->exit_at }}</td>
                            </tr>
                        @empty
                            <p>Data Kosong</p>
                        @endforelse
                        {{--
                        @foreach ($peminjaman as $data)
                            <tr>
                                <td class="text-center">{{ $no_peminjaman++ }}</td>
                                <td>{{ $data->asset->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->exit_at)->format('d-m-Y') }}</td>
                                <td>{{ $data->exit_pic }}</td>
                                <td>{{ $data->warehouse->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.peminjaman.edit', $data->id) }}" title="Edit">
                                        <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <form action="{{ route('dashboard.peminjaman.destroy', $data->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                            title="Delete" style="border: none; background: none; cursor: pointer;">
                                            <i class="fa fa-trash text-danger" style="font-size: 20px"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
