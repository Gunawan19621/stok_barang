<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateType_Peti extends FormRequest
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
            'type' => 'required|string|max:20',
            'size_peti' => 'required|string|max:25',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Type Peti tidak boleh kosong',
            'type.string' => 'Type Peti harus berupa string',
            'type.max' => 'Type Peti maksimal 20 karakter',
            'size_peti.required' => 'Size Peti tidak boleh kosong',
            'size_peti.string' => 'Size Peti harus berupa string',
            'size_peti.max' => 'Size Peti maksimal 25 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa string',
        ];
    }
}
