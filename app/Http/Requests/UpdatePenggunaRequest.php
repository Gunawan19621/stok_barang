<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenggunaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255|min:3',
            'phone' => 'required|numeric|digits_between:10,13',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tgl_lahir' => 'date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'alamat' => 'required|string|max:255|min:3',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.',
            'string' => ':attribute harus berupa string.',
            'numeric' => ':attribute harus berupa angka.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'digits_between' => ':attribute harus berjumlah antara :min sampai :max digit.',
            'email' => ':attribute harus berupa email.',
            'date' => ':attribute harus berupa tanggal.',
            'in' => ':attribute harus salah satu dari jenis berikut :values.',
            'max' => ':attribute maksimal berjumlah :max karakter.',
            'min' => ':attribute minimal berjumlah :min karakter.',
            'regex' => ':attribute hanya boleh berisi huruf.',
        ];
    }
}
