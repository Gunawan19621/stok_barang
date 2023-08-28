@extends('layouts.main')
@section('title', 'Profil')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <label for="name" class="col-form-label" style="font-size: 14px;">Nama</label>
                    <div class="mb-2">
                        <input pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');"
                            class="form-control" type="text" id="name" name="name"
                            value="{{ old('name', auth()->user()->name) }}" placeholder="Masukan nama anda">
                        @error('name')
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

                    <label for="phone" class="col-form-label" style="font-size: 14px;">No.
                        Handphone</label>
                    <div class="mb-2">
                        <input class="form-control" type="tel" id="phone" name="phone"
                            value="{{ old('phone', auth()->user()->phone) }}" placeholder="Masukan nomor telepone anda">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3 text-center">
                    {{-- <label for="name">Foto Profil</label><br>
                    <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ auth()->user()->name }}"
                        class="rounded-circle thumb-xl profile-image" style="width: 155px"><br>
                    <button type="button" class="btn btn-secondary mt-2">Upload</button>
                    <button type="button" class="btn btn-danger mt-2">HAPUS</button> --}}
                    <label for="foto">Foto Profil</label><br>
                    @if (auth()->user()->foto === null)
                        <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ auth()->user()->name }}"
                            class="rounded-circle thumb-xl profile-image" style="width: 155px; cursor: pointer;"><br>
                    @else
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="{{ auth()->user()->name }}"
                            class="rounded-circle img-thumbnail thumb-xl profile-image"
                            style="width: 155px; cursor: pointer;"><br>
                    @endif
                    {{-- <button type="button" class="btn btn-secondary mt-2">Upload</button>
                    <button type="button" class="btn btn-danger mt-2">HAPUS</button> --}}
                    <div class="button-items">
                        <form action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="foto" id="photo" class="form-control-file d-none"
                                    accept=".jpeg,.jpg,.png,.jfif">
                            </div>
                            <button type="submit" class="btn btn-sm col-4 btn-info">Simpan</button>
                            <a href="#" class="btn btn-sm col-4 btn-secondary">Hapus</a>
                        </form>
                    </div>
                    {{-- <label for="upload-image">
                        <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ auth()->user()->name }}"
                            class="rounded-circle thumb-xl profile-image" style="width: 155px; cursor: pointer;">
                    </label>
                    <input type="file" id="upload-image" style="display: none;"><br> --}}
                </div>
                <div class="col-12">
                    <div class="mb-2">
                        <label for="tgl_lahir" class="col-form-label" style="font-size: 14px;">Tanggal
                            Lahir</label>
                        <input class="form-control" type="date"
                            value="{{ old('tgl_lahir', auth()->user()->tgl_lahir) }}" id="tgl_lahir">
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
                            <option value="Islam" {{ old('agama', auth()->user()->agama) == 'Islam' ? 'selected' : '' }}>
                                Islam</option>
                            <option value="Kristen"
                                {{ old('agama', auth()->user()->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                            </option>
                            <option value="Katolik"
                                {{ old('agama', auth()->user()->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                            </option>
                            <option value="Hindu" {{ old('agama', auth()->user()->agama) == 'Hindu' ? 'selected' : '' }}>
                                Hindu</option>
                            <option value="Buddha" {{ old('agama', auth()->user()->agama) == 'Buddha' ? 'selected' : '' }}>
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

                    <label for="alamat" class="col-form-label" style="font-size: 14px;">Alamat</label>
                    <div class="mb-2">
                        <textarea pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');" class="form-control"
                            id="alamat" name="alamat" placeholder="Masukkan alamat Anda">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger mt-2 col-1">BATAL</button>
                    <button type="button" class="btn btn-success mt-2 ml-2 col-1">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>

    <!-- update data foto -->
    <!-- End update data foto -->
@endsection
