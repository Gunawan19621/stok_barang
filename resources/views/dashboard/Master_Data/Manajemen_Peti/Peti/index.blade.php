@extends('layouts.main')
@section('content')
    <style>
        .table th {
            white-space: nowrap;
        }

        .table td {
            white-space: nowrap;
        }
    </style>

    @include('layouts.components.alert-prompt')
    @if (auth()->user()->role_id == 1)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data Peti</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('dashboard.peti.create') }}" class="btn btn-success btn-icon-split">
                            <span class="text">Tambah Peti</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10px">No</th>
                                <th>User</th>
                                <th>Customer</th>
                                <th>WH</th>
                                <th>Kode Customer</th>
                                <th>Tipe Peti</th>
                                <th>Ukuran Peti</th>
                                <th>Lot No</th>
                                <th>Status Peti</th>
                                <th>Packing No</th>
                                <th>Fix Lot</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nopeti = 1;
                            @endphp
                            @forelse ($peti as $data_peti)
                                <tr>
                                    <td class="text-center">{{ $nopeti++ }}</td>
                                    <td>{{ $data_peti->created_by }}</td>
                                    <td>{{ $data_peti->customer->name }}</td>
                                    <td>{{ $data_peti->warehouse->name }}</td>
                                    <td>{{ $data_peti->customer->code_customer }}</td>
                                    <td>{{ $data_peti->tipe_peti->type }}</td>
                                    <td>{{ $data_peti->tipe_peti->size_peti }}</td>
                                    <td>{{ $data_peti->customer->lot_no }}</td>
                                    <td>{{ $data_peti->status_disposal }}</td>
                                    <td class="text-right">{{ $data_peti->packing_no }}</td>
                                    <td>{{ $data_peti->fix_lot }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.peti.show', [$data_peti->id]) }}">
                                            <i class="fa fa-eye mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('dashboard.peti.edit', [$data_peti->id]) }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <form action="{{ route('dashboard.peti.destroy', $data_peti->id) }}" method="POST"
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
    @else
        @include('pages.user.Master_Data.Manajemen_Peti.Peti.index')
    @endif
@endsection
