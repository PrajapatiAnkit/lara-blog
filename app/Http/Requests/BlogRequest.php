<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'blogTitle' => 'required',
            'blogCategory' => 'required',
            'blogDescription' => 'required',
        ];
    }

    /**
     * @todo it customises the error messages
     * @return array
     */
    public function messages()
    {
        return [
            'blogTitle.required' => 'Please enter title',
            'blogCategory.required' => 'Please select category',
            'blogDescription.required' => 'Please write some description',
        ];
    }

}
