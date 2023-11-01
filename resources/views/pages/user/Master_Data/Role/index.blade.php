<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-6">
                <h5 class="m-0 font-weight-bold text-primary mt-2">Data Role</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablebarang" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nama Role</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $norole = 1;
                    @endphp
                    @foreach ($role as $data_role)
                        <tr>
                            <td class="text-center">{{ $norole++ }}</td>
                            <td>{{ $data_role->name }}</td>
                            <td>{{ $data_role->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
