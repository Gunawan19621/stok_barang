<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiUpdateRole extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Role harus diisi',
            'name.string' => 'Nama Role harus berupa string',
            'name.max' => 'Nama Role maksimal 50 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
        ];
    }
}
