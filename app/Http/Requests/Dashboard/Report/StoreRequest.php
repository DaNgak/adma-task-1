<?php

namespace App\Http\Requests\Dashboard\Report;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:20',
            'identify_type' => 'required|string|max:255',
            'identify_number' => 'required|string|max:255',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    function messages() : array {
        return [ 
            'required' => ':attribute harus diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => [
                'string' => ':attribute tidak boleh lebih dari :max karakter.',
            ],
            'email' => ':attribute harus berupa alamat email yang valid.',
            'phone_number' => ':attribute harus berupa nomor telepon yang valid.',
            'identify_type' => ':attribute harus berupa jenis identifikasi yang valid.',
            'identify_number' => ':attribute harus berupa nomor identifikasi yang valid.',
            'pob' => 'Tempat lahir harus diisi.',
            'dob' => 'Tanggal lahir harus diisi dengan format yang benar.',
            'date' => 'Format tanggal tidak valid.',
            'address' => 'Alamat harus diisi.',
            'title' => ':attribute harus diisi.',
            'image.required' => 'File gambar harus diunggah.',
            'image.mimes' => 'Tipe file gambar yang diizinkan: :values.',
            'image:max' => 'Ukuran file gambar tidak boleh lebih dari :max KB.',
        ];
    }
}
