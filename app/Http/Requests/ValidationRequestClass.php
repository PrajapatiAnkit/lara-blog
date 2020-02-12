<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class ValidationRequestClass extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        // we can access the form valriables data $this->userName;
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
            'userName' => 'required',
            'userPassword' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'userName.required' => 'Username is required',
           // 'userName.max' => 'Username can not be greater than 5 characters',
            'userPassword.required' => 'Password is required',
        ];
    }

}
