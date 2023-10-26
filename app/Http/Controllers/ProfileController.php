<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePenggunaRequest;

class ProfileController extends Controller
{
    //halaman setting profile
    public function setting(Request $request): View
    {
        $data = [
            'active' => 'menu-profile',
        ];
        return view('profil.setting', [
            'user' => $request->user(),
        ], $data);
    }

    // Halaman edit profile
    public function edit()
    {
        $data = [
            'active' => 'menu-profile',
        ];
        return view('profil.profil', $data);
    }

    //Proses update Profile
    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi jenis file gambar
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'address' => 'required',
        ]);

        try {
            $pengguna = User::findOrFail($id);

            // Handle foto upload if provided
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($pengguna->foto) {
                    Storage::delete('public/' . $pengguna->foto);
                }

                // Generate nama file acak
                // $randomFileName = Str::random(20) . '.' . $request->file('foto')->getClientOriginalExtension();
                // $fotoPath = $request->file('foto')->storeAs('public/Profile_foto', $randomFileName);
                // $pengguna->foto = $randomFileName;
                $randomFileName = Str::random(20); // Menghasilkan nama file acak dengan panjang 20 karakter
                $fotoPath = $request->file('foto')->storeAs('public/Profile_foto', $randomFileName);
                $pengguna->foto = str_replace('public/', '', $fotoPath);
            }

            // Update other fields
            $pengguna->fullname = $request->fullname;
            $pengguna->email = $request->email;
            $pengguna->no_hp = $request->no_hp;
            $pengguna->tgl_lahir = $request->tgl_lahir;
            $pengguna->jenis_kelamin = $request->jenis_kelamin;
            $pengguna->agama = $request->agama;
            $pengguna->address = $request->address;

            $pengguna->save();

            return redirect()->back()->with('success', 'Profil pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data pengguna gagal diubah');
        }
    }

    //Proses update Profile Photo
    // public function updatePhoto(Request $request)
    // {
    //     // dd('okr');
    //     $user = User::find(auth()->user()->id);
    //     if ($request->hasFile('foto')) {
    //         // Mengunggah file foto profil
    //         $file = $request->file('foto');
    //         $foto = $file->store('profile-fotos');
    //         $user->update(['foto' => $foto]);
    //     }

    //     // Logika lain yang diperlukan setelah update foto profil
    //     return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    // }

    //Proses update Profile Informasi
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request)
    // {
    //     $user = Auth::user();

    //     // Validasi password
    //     if (!Hash::check($request->password, $user->password)) {
    //         return back()->withErrors([
    //             'password' => 'The provided password does not match your current password.',
    //         ]);
    //     }

    //     // Hapus akun
    //     $user->delete();

    //     // Logout
    //     Auth::logout();

    //     return redirect('/');
    // }
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
