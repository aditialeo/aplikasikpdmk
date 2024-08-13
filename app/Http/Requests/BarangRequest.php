<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'kd_barang' => 'required',
            'merk_id'=> 'required',
            'suplair_id' => 'required',
            'tanggal_keluar'=> 'required',
            'jumlah_keluar'=>'required',
        ];
    }

    // Untuk mengganti message validasi
    // public function messages(): array
    // {
    //     return [
    //         'tanggal_keluar.required' => ':attribute Isi Dong'
    //     ];
    // }
}
