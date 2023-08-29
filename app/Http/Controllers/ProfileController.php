<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //halaman setting profile
    public function setting(Request $request): View
    {
        return view('profil.setting', [
            'user' => $request->user(),
        ]);
    }

    // Halaman edit profile
    public function edit()
    {
        return view('profil.profil');
    }

    //Proses update Profile
    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|min:3',
            'phone' => 'required|numeric|digits_between:10,13',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tgl_lahir' => 'date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'alamat' => 'required|string|max:255|min:3',
        ]);

        try {
            $pengguna = User::findOrFail($id);

            // Handle foto upload if provided
            if ($request->hasFile('foto')) {
                // Upload and update foto
                $fotoPath = $request->file('foto')->store('profile_photos', 'public');
                $pengguna->foto = $fotoPath;
            }

            // Update other fields
            $pengguna->name = $request->name;
            $pengguna->email = $request->email;
            $pengguna->phone = $request->phone;
            $pengguna->tgl_lahir = $request->tgl_lahir;
            $pengguna->jenis_kelamin = $request->jenis_kelamin;
            $pengguna->agama = $request->agama;
            $pengguna->alamat = $request->alamat;

            $pengguna->save();

            return redirect()->back()->with('success', 'Profil pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            // Uncomment this line to see the error details
            // dd($th);
            return redirect()->back()->with('error', 'Data pengguna gagal diubah');
        }
    }
    // {
    //     // dd('oke');
    //     $request->validate([
    //         'name' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s]+$/',
    //         'email' => 'required|email|max:255|min:3',
    //         'phone' => 'required|numeric|digits_between:10,13',
    //         'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'tgl_lahir' => 'date',
    //         'jenis_kelamin' => 'required|in:L,P',
    //         'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
    //         'alamat' => 'required|string|max:255|min:3',
    //     ]);
    //     // dd($request);
    //     try {
    //         $pengguna = User::findOrFail($id);
    //         $pengguna->update($request->validated());
    //         return redirect()->back()->with('success', 'Profil pengguna berhasil diperbarui');
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         return redirect()->back()->with('error', 'Data pengguna gagal diubah');
    //     }
    // }

    //Proses update Profile Photo
    public function updatePhoto(Request $request)
    {
        // dd('okr');
        $user = User::find(auth()->user()->id);
        if ($request->hasFile('foto')) {
            // Mengunggah file foto profil
            $file = $request->file('foto');
            $foto = $file->store('profile-fotos');
            $user->update(['foto' => $foto]);
        }

        // Logika lain yang diperlukan setelah update foto profil
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    //Proses update Profile Informasi
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::back()->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
