@extends('layouts.main')
@section('title', 'Setting Akun')
@section('content')
    <div class="card mb-2">
        <div class="card-body">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Informasi Akun
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Perbarui informasi nama profil dan alamat email akun Anda.
                </p>
            </header>
            <div class="py-12">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="fullname" class="block font-semibold text-gray-800">
                            Nama
                        </label>
                        <input id="fullname" name="fullname" type="text" class="mt-1 block w-full"
                            value="{{ old('fullname', $user->fullname) }}" required autofocus autocomplete="fullname">
                        @if ($errors->has('fullname'))
                            <p class="text-red-500">{{ $errors->first('fullname') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="block font-semibold text-gray-800">
                            Email
                        </label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full"
                            value="{{ old('email', $user->email) }}" required autocomplete="email">
                        @if ($errors->has('email'))
                            <p class="text-red-500">{{ $errors->first('email') }}</p>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="mt-2 text-gray-800">
                                Alamat email Anda belum diverifikasi.
                                <button form="send-verification"
                                    class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Klik di sini untuk mengirim ulang email verifikasi.
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-green-600">
                                        Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4 mt-2">
                        <button type="submit"
                            class="btn btn-sm btn-primary hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                            Simpan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-gray-600">
                                Tersimpan.
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-body">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Ubah Password
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                </p>
            </header>
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div>
                    <label for="current_password" class="block font-semibold text-gray-800">
                        kata sandi saat ini
                    </label>
                    <input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                        autocomplete="current-password">
                    @if ($errors->has('updatePassword.current_password'))
                        <p class="text-red-500">{{ $errors->first('updatePassword.current_password') }}</p>
                    @endif
                </div>
                <div>
                    <label for="password" class="block font-semibold text-gray-800">
                        kata sandi baru
                    </label>
                    <input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password">
                    @if ($errors->has('updatePassword.password'))
                        <p class="text-red-500">{{ $errors->first('updatePassword.password') }}</p>
                    @endif
                </div>
                <div>
                    <label for="password_confirmation" class="block font-semibold text-gray-800">
                        konfirmasi sandi
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full"
                        autocomplete="new-password">
                    @if ($errors->has('updatePassword.password_confirmation'))
                        <p class="text-red-500">{{ $errors->first('updatePassword.password_confirmation') }}</p>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="btn btn-sm btn-primary hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded">
                        Save
                    </button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">
                            Saved.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="card mb-2">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
                @csrf
                @method('DELETE')

                <div>
                    <x-danger-button type="submit">Delete Account</x-danger-button>
                </div>
            </form> --}}
    {{-- <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Delete Account
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                    your account, please download any data or information that you wish to retain.
                </p>
            </header>

            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                Delete Account
            </button>

            <div x-data="{ show: false }">
                <div x-on:confirm-user-deletion.window="show = true"></div>

                <div x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                    <form method="post" action="{{ route('profile.destroy') }}" class="bg-white p-6 rounded-lg shadow-xl">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Are you sure you want to delete your account?
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please
                            enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div class="mt-6">
                            <label for="password" class="block font-semibold text-gray-800 sr-only">
                                Password
                            </label>

                            <input id="password" name="password" type="password" class="mt-1 block w-3/4"
                                placeholder="Password">

                            <div class="text-red-500 mt-2">
                                @if ($errors->has('userDeletion.password'))
                                    {{ $errors->first('userDeletion.password') }}
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" x-on:click="show = false"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                                Cancel
                            </button>

                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded ml-3">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}
    {{-- @include('profile.partials.delete-user-form') --}}
    {{-- </div>
    </div> --}}
@endsection
