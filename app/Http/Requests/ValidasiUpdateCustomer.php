<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiUpdateCustomer extends FormRequest
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
            'code_customer' => 'required|string|max:15|unique:customers,code_customer',
            'lot_no' => 'required|string|max:50',
            'no_tlp' => 'required|numeric',
            'address' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom name wajib diisi.',
            'name.string' => 'Kolom name harus berupa teks.',
            'name.max' => 'Kolom name tidak boleh lebih dari :max karakter.',
            'code_customer.required' => 'Kolom code_customer wajib diisi.',
            'code_customer.string' => 'Kolom code_customer harus berupa teks.',
            'code_customer.max' => 'Kolom code_customer tidak boleh lebih dari :max karakter.',
            'code_customer.unique' => 'Kolom code_customer sudah ada.',
            'lot_no.required' => 'Kolom lot_no wajib diisi.',
            'lot_no.string' => 'Kolom lot_no harus berupa teks.',
            'no_tlp.required' => 'Kolom no_tlp wajib diisi.',
            'no_tlp.numeric' => 'Kolom no_tlp harus berisi angka.',
            'no_tlp.max' => 'Kolom no_tlp tidak boleh lebih dari :max karakter.',
            'address.required' => 'Kolom address wajib diisi.',
            'address.string' => 'Kolom address harus berupa teks.',
        ];
    }
}
