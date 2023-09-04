<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'username' => ['required', 'string', 'min:8', 'unique:users', 'regex:/^[a-z0-9_.]+$/',],
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     *  Get the error messages for the defined validation rules.
     *  
     * @return array
     */ 
    public function messages(): array
    {
        return [
            'name' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'max' => 'Input :attribute tidak boleh lebih dari :max karakter.',
            ],
            'email' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'email' => 'Input :attribute harus berupa alamat email yang valid.',
                'max' => 'Input :attribute tidak boleh lebih dari :max karakter.',
                'unique' => 'Input :attribute sudah digunakan.',
            ],
            'username' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'min' => 'Input :attribute harus memiliki minimal :min karakter.',
                'unique' => 'Input :attribute sudah digunakan.',
                'regex' => 'Input :attribute format tidak valid (hanya huruf a-z, angka 0-9, titik dan underscore).',
            ],
            'phone_number' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'max' => 'Input :attribute tidak boleh lebih dari :max karakter.',
            ],
            'password' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'min' => 'Input :attribute harus memiliki minimal :min karakter.',
                'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            ],
        ];
    }
}
