@extends('layouts.main')
@section('title', 'Update Data User')
@section('content')
    <div class="card m-3">
        <div class="card-body m-2">
            <h3>Detail User</h3>
            <hr class="border">
            <form action="{{ route('user.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="fullname" class="col-form-label">Nama:</label>
                    <input class="form-control" name="fullname" type="text" id="fullname"
                        placeholder="Masukan nama lengkap" value="{{ $user->fullname }}" pattern="[^0-9]+" required
                        oninput="this.value=this.value.replace(/[0-9]/g,'');">

                    <label for="nip" class="col-form-label">NIP:</label>
                    <input class="form-control" name="nip" type="text" id="nip" placeholder="Masukan NIP anda"
                        value="{{ $user->nip }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                        required>

                    <label for="email" class="col-form-label">Email:</label>
                    <input class="form-control" name="email" type="email" id="email"
                        placeholder="Masukan email anda" value="{{ $user->email }}" required>

                    <label for="no_hp" class="col-form-label">No. Hp:</label>
                    <input class="form-control" name="no_hp" type="text" id="no_hp"
                        placeholder="Masukan nomor telepon anda" value="{{ $user->no_hp }}"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>

                    <label for="divisi" class="col-form-label">Divisi:</label>
                    <input class="form-control" name="divisi" type="text" id="divisi"
                        placeholder="Masukan divisi anda" value="{{ $user->divisi }}" pattern="[^0-9]+" required
                        oninput="this.value=this.value.replace(/[0-9]/g,'');">


                    <label for="address" class="col-form-label">Alamat:</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Masukan detail alamat anda" required>{{ $user->address }}</textarea>

                    <label for="status" class="col-form-label">Status:</label>
                    <select class="form-control" name="status" type="text" id="status">
                        <option disabled selected>Pilih Status</option>
                        <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="tidak aktif" {{ old('status', $user->status) == 'tidak aktif' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                    <label for="role_id" class="col-form-label">Hak Akses:</label>
                    <select class="form-control" name="role_id" type="text" id="role_id">
                        <option disabled selected>Pilih Hak Akses</option>
                        @foreach ($role as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>

                    <label for="warehouse_id" class="col-form-label">DItugaskan:</label>
                    <select class="form-control" name="warehouse_id" type="text" id="warehouse_id">
                        <option disabled selected>Pilih DItugaskan</option>
                        @foreach ($warehouse as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="window.location.href = '{{ route('user.index') }}'">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
