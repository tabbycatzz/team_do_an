<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' =>  'required|file|mimes:jpeg,png,psd',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description',
            'content.required' => 'Please enter content',
            'image.required' => 'Please choose image',
            'image.file' => 'Please choose image file',
            'image.mimes' => 'Please choose image (jpeg, png, psd)',
            'category.required' => 'Please choose category',
        ];
    }
}
