@extends('layouts.main')
@section('title', 'Manajemen User')
@section('content')
    {{-- <h1>Halaman Manajement User</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Data User</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('dashboard.user.create') }}" class="btn btn-success btn-icon-split">
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
                                    <a href="{{ route('dashboard.user.show', [$data->id]) }}">
                                        <i class="fa fa-eye mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <a href="{{ route('dashboard.user.edit', [$data->id]) }}">
                                        <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <form action="{{ route('dashboard.user.destroy', $data->id) }}" method="POST"
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
                        @empty
                            <p>Data Kosong</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
