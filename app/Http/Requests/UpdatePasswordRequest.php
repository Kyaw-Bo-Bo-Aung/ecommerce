<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'cpassword' => 'required',
            'npassword' => 'required',
            'confirm_password' => 'required'
        ];
    }

    public function messages()
{
    return [
        'username.required' => 'Username is required',
        'email.required' => 'Email is required',
        'type.required' => 'Admin type is required',
        'cpassword.required' => 'Current password is required',
        'npassword.required' => 'New password is required',
        'confirm_password.required' => 'Confirm password is required'
    ];
}
}
