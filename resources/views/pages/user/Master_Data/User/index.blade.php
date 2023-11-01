<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-6">
                <h5 class="m-0 font-weight-bold text-primary mt-2">Data User</h5>
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
