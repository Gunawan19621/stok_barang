@extends('layouts.main')
@section('title', 'Profil')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.updateprofile', auth()->user()->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-9">
                        <label for="fullname" class="col-form-label" style="font-size: 14px;">Nama</label>
                        <div class="mb-2">
                            <input pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');"
                                class="form-control" type="text" id="fullname" name="fullname"
                                value="{{ old('fullname', auth()->user()->fullname) }}" placeholder="Masukan nama anda">
                            @error('fullname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="email" class="col-form-label" style="font-size: 14px;">Alamat
                            Email</label>
                        <div class="mb-2">
                            <input class="form-control" type="email" id="email" name="email"
                                value="{{ old('email', auth()->user()->email) }}" readonly>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="no_hp" class="col-form-label" style="font-size: 14px;">No.
                            Handphone</label>
                        <div class="mb-2">
                            <input class="form-control" type="text" id="no_hp" name="no_hp"
                                value="{{ old('no_hp', auth()->user()->no_hp) }}" placeholder="Masukan nomor telepon anda">
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <label for="foto">Foto Profil</label><br>
                        @if (auth()->user()->foto == null)
                            <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ auth()->user()->name }}"
                                class="rounded-circle thumb-xl profile-image"
                                style="width: 155px; height: 155px; cursor: pointer;"><br>
                        @else
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="{{ auth()->user()->name }}"
                                class="rounded-circle img-thumbnail thumb-xl profile-image"
                                style="width: 155px; height: 155px; cursor: pointer;"><br>
                        @endif
                        <div class="button-items mt-2">
                            <label for="photo" class="btn btn-sm col-4 btn-info mt-2">
                                <input type="file" name="foto" id="photo" class="d-none" accept="image/*">
                                Upload
                            </label>
                            <button type="button" class="btn btn-sm col-4 btn-danger"
                                onclick="window.location.reload()">Batal</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-2">
                            <label for="tgl_lahir" class="col-form-label" style="font-size: 14px;">Tanggal
                                Lahir</label>
                            <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir"
                                value="{{ \Carbon\Carbon::parse(old('tgl_lahir', auth()->user()->tgl_lahir))->format('Y-m-d') }}"
                                placeholder="Masukan Tanggal Asset" required>
                            @error('tgl_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="jenis_kelamin" class="col-form-label" style="font-size: 14px;">Jenis
                            Kelamin</label>
                        <div class="mb-2">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option selected disabled>Pilih jenis kelamin</option>
                                <option value="L"
                                    {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="agama" class="col-form-label" style="font-size: 14px;">Agama</label>
                        <div class="mb-2">
                            <select class="form-control" id="agama" name="agama">
                                <option selected disabled>Pilih agama</option>
                                <option value="Islam"
                                    {{ old('agama', auth()->user()->agama) == 'Islam' ? 'selected' : '' }}>
                                    Islam</option>
                                <option value="Kristen"
                                    {{ old('agama', auth()->user()->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="Katolik"
                                    {{ old('agama', auth()->user()->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                                </option>
                                <option value="Hindu"
                                    {{ old('agama', auth()->user()->agama) == 'Hindu' ? 'selected' : '' }}>
                                    Hindu</option>
                                <option value="Buddha"
                                    {{ old('agama', auth()->user()->agama) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha
                                </option>
                                <option value="Konghucu"
                                    {{ old('agama', auth()->user()->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                            @error('agama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="address" class="col-form-label" style="font-size: 14px;">Alamat</label>
                        <div class="mb-2">
                            <textarea pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');" class="form-control"
                                id="address" name="address" placeholder="Masukkan alamat Anda">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mt-2"
                            onclick="window.location.href = '{{ route('profile.setting') }}';">EDIT PASSWORD</button>
                        <button type="submit" class="btn btn-success mt-2 ml-2 col-1">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
