<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
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
