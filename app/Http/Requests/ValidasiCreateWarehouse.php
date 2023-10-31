<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateWarehouse extends FormRequest
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
            'name' => 'required|string|max:32',
            'description' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.string' => 'Kolom nama harus berupa teks.',
            'name.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'description.required' => 'Kolom deskripsi wajib diisi.',
            'description.string' => 'Kolom deskripsi harus berupa teks.',
            'description.max' => 'Kolom deskripsi tidak boleh lebih dari :max karakter.',
            'address.required' => 'Kolom alamat wajib diisi.',
            'address.string' => 'Kolom alamat harus berupa teks.',
            'address.max' => 'Kolom alamat tidak boleh lebih dari :max karakter.',
        ];
    }
}
