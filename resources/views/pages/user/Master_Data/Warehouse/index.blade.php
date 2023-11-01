<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-6">
                <h5 class="m-0 font-weight-bold text-primary mt-2">Data Gudang</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No.</th>
                        <th>Nama Gudang</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nowarehouses = 1;
                    @endphp
                    @foreach ($warehouses as $data)
                        <tr>
                            <td class="text-center" style="width: 50px;">{{ $nowarehouses++ }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
