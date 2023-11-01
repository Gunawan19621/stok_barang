<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreatePeti extends FormRequest
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
            'tipe_peti_id' => 'required|exists:type_petis,id',
            'warna' => 'required|string|max:50',
            'customer_id' => 'required|exists:customers,id',
            'warehouse_id' => 'required|exists:m_warehouses,id',
            'jumlah' => 'required|numeric|min:1',
            'date_pembuatan' => 'required|date',
            'status_disposal' => 'nullable|string',
            'packing_no' => 'nullable|integer',
            'fix_lot' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'tipe_peti_id.required' => 'Tipe Peti harus diisi',
            'tipe_peti_id.exists' => 'Tipe Peti tidak ditemukan',
            'warna.required' => 'Warna harus diisi',
            'warna.string' => 'Warna harus berupa string',
            'warna.max' => 'Warna maksimal 50 karakter',
            'customer_id.required' => 'Customer harus diisi',
            'customer_id.exists' => 'Customer tidak ditemukan',
            'warehouse_id.required' => 'Warehouse harus diisi',
            'warehouse_id.exists' => 'Warehouse tidak ditemukan',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'date_pembuatan.required' => 'Tanggal Pembuatan harus diisi',
            'date_pembuatan.date' => 'Tanggal Pembuatan harus berupa tanggal',
            'status_disposal.string' => 'Status Disposal harus berupa string',
            'packing_no.integer' => 'Packing No harus berupa angka',
            'fix_lot.string' => 'Fix Lot harus berupa string',
            'fix_lot.max' => 'Fix Lot maksimal 100 karakter',
        ];
    }
}
