@extends('layouts.main')
@section('content')
    @include('layouts.components.alert-prompt')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 font-weight-bold text-primary mt-2">Data Customer</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('dashboard.customer.create') }}" class="btn btn-success btn-icon-split">
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
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Kode Customer</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nocustomer = 1;
                        @endphp
                        @forelse ($customer as $data_customer)
                            <tr>
                                <td class="text-center">{{ $nocustomer++ }}</td>
                                <td>{{ $data_customer->name }}</td>
                                <td>{{ $data_customer->code_customer }}</td>
                                <td>{{ $data_customer->no_tlp }}</td>
                                <td>{{ $data_customer->address }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.customer.show', [$data_customer->id]) }}">
                                        <i class="fa fa-eye mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <a href="{{ route('dashboard.customer.edit', [$data_customer->id]) }}">
                                        <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                    </a>
                                    <form action="{{ route('dashboard.customer.destroy', $data_customer->id) }}"
                                        method="POST" style="display: inline;">
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
