<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:32',
            'fullname' => 'required|string|max:32',
            'nip' => 'nullable|numeric|max:20',
            'email' => 'required|email|string|max:45',
            'no_hp' => 'nullable|numeric|max:15',
            'divisi' => 'nullable|string|max:50',
            'foto' => 'nullable|string|max:255',
            'role_id' => 'required|exists:m_roles,id',
            'warehouse_id' => 'nullable|exists:m_warehouses,id',
            'address' => 'nullable|string',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:6|max:16',
            'created_by' => 'nullable|string|max:32',
            'updated_by' => 'nullable|string|max:32',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Kolom username wajib diisi.',
            'username.string' => 'Kolom username harus berupa teks.',
            'username.max' => 'Kolom username tidak boleh lebih dari :max karakter.',
            'fullname.required' => 'Kolom fullname wajib diisi.',
            'fullname.string' => 'Kolom fullname harus berupa teks.',
            'fullname.max' => 'Kolom fullname tidak boleh lebih dari :max karakter.',
            'nip.numeric' => 'Kolom NIP harus berisi angka.',
            'nip.max' => 'Kolom NIP tidak boleh lebih dari :max karakter.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'no_hp.numeric' => 'Kolom no_hp harus berisi angka.',
            'no_hp.max' => 'Kolom no_hp tidak boleh lebih dari :max karakter.',
            'divisi.string' => 'Kolom divisi harus berupa teks.',
            'divisi.max' => 'Kolom divisi tidak boleh lebih dari :max karakter.',
            'foto.string' => 'Kolom foto harus berupa teks.',
            'foto.max' => 'Kolom foto tidak boleh lebih dari :max karakter.',
            'role_id.required' => 'Kolom role_id wajib diisi.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',
            'warehouse_id.exists' => 'Warehouse yang dipilih tidak valid.',
            'address.string' => 'Kolom address harus berupa teks.',
            'email_verified_at.date' => 'Format tanggal email_verified_at tidak valid.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.string' => 'Kolom password harus berupa teks.',
            'password.min' => 'Kolom password minimal harus :min karakter.',
            'password.max' => 'Kolom password tidak boleh lebih dari :max karakter.',
            'created_by.string' => 'Kolom created_by harus berupa teks.',
            'created_by.max' => 'Kolom created_by tidak boleh lebih dari :max karakter.',
            'updated_by.string' => 'Kolom updated_by harus berupa teks.',
            'updated_by.max' => 'Kolom updated_by tidak boleh lebih dari :max karakter.',
        ];
    }
}
