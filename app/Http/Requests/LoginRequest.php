<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    // Cutomizing validation errors
    public function messages()
    {
        return [
            'email.required' => 'Please enter your email adddress',
            'email.email' => 'Please enter A Valid email adddress',
            'password.required' => 'Please enter your password'
        ];
    }
}
