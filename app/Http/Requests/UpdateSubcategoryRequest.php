<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'category_id' => 'required',
            'url' => 'required|min:2|max:255',
            'new_image' => 'sometimes|image',
            'current_image' => 'sometimes',
            'discount' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'image.image' => 'File must be image',
            'category_id.required' => 'Category field is required',
        ];
    }
}
