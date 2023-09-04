<?php

namespace App\Http\Requests\Dashboard\Category;

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
            'name' => 'required|string|max:255|unique:categories,name',
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
                'unique' => 'Input :attribute sudah digunakan.',
            ],
        ];
    }
}
