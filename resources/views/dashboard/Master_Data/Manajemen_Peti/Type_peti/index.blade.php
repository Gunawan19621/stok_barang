@extends('layouts.main')
@section('content')
    @include('layouts.components.alert-prompt')
    @if (auth()->user()->role_id == 1)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h5 class="m-0 font-weight-bold text-primary mt-2">Data Tipe Peti</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('dashboard.typepeti.create') }}" class="btn btn-success btn-icon-split">
                            <span class="text">Tambah Tipe Peti</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20px">No</th>
                                <th>Tipe Peti</th>
                                <th>Ukuran Peti</th>
                                <th>Deskripsi Peti</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $notype = 1;
                            @endphp
                            @forelse ($typepeti as $data_typepeti)
                                <tr>
                                    <td class="text-center">{{ $notype++ }}</td>
                                    <td>{{ $data_typepeti->type }}</td>
                                    <td>{{ $data_typepeti->size_peti }}</td>
                                    <td>{{ $data_typepeti->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.typepeti.show', [$data_typepeti->id]) }}">
                                            <i class="fa fa-eye mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <a href="{{ route('dashboard.typepeti.edit', [$data_typepeti->id]) }}">
                                            <i class="fa fa-edit mr-2" style="font-size: 20px"></i>
                                        </a>
                                        <form action="{{ route('dashboard.typepeti.destroy', $data_typepeti->id) }}"
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
    @else
        @include('pages.user.Master_Data.Manajemen_Peti.Type_peti.index')
    @endif
@endsection
