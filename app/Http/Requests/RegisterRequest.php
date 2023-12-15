<?php

namespace App\Http\Requests;

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
            'name' =>'required',
            'email' =>'email|unique:users,email|required',
            'password' => ['required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/']
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'En az 8 karakter, 1 rakam ve bir büyük harf girmelisiniz.',
        ];
    }
}
