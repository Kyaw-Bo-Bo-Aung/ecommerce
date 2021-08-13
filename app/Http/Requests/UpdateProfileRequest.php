<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => 'required',
            'type' => 'required',
            'username' => 'required|min:2|max:255',
            'mobile' => 'required|regex:/[0-9]+/|min:6|max:12',
            'new_photo' => 'sometimes|image'
        ];
    }
    public function messages()
    {
        return [
            'mobile.required' => 'The mobile number is required',
            'mobile.min' => 'The mobile number should be at least 6 characters',
            'mobile.max' => 'The mobile number allows only 12 characters',
            'mobile.regex' => 'The mobile number should be integer',
        ];
    }
}
