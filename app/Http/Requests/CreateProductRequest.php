<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'subcategory_id' => 'required',
            'code' => 'required',
            'color' => 'required',
            'image' => 'image',
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
            'weight' => 'numeric',
            'url' => 'required',
            'meta_title' => 'required|min:2|max:255',
            'meta_description' => 'required',
            'meta_keywords' => 'required|min:2|max:255',
        ];
    }
    public function messages() {
        return ['subcategory_id.required' => 'Subcategory is required'];
    }
}
