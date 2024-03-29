<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *  
     * @return array
     */
    public function messages(): array
    {
        return [
            'email' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'max' => 'Input :attribute tidak boleh lebih dari :max karakter.',
                'email' => 'Input :attribute harus berupa alamat email yang valid.',
            ],
            'password' => [
                'required' => 'Input :attribute wajib diisi.',
                'string' => 'Input :attribute harus berupa teks.',
                'max' => 'Input :attribute tidak boleh lebih dari :max karakter.',
            ],
        ];
    }
}
