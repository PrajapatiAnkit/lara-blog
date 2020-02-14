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
          if ($this->input('validationRule') == 'addBlog'){

              $validationsRules = [
                  'blogTitle' => 'required',
                  'blogCategory' => 'required',
                  'blogDescription' => 'required',
                  'blogImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
              ];
          }
         else if ($this->input('validationRule') == 'adminLogin'){
                $validationsRules =  [
                'userName' => 'required',
                'userPassword' => 'required',
            ];
          }

       else if ($this->input('validationRule') == 'addCategory'){
            $validationsRules =  [
                'categoryName' => 'required',
            ];
        }
      return $validationsRules;



    }


    public function messages()
    {
        return [
            'userName.required' => 'Username is required',
            'userPassword.required' => 'Password is required',
            'blogTitle.required' => 'Blog is required',
            'blogCategory.required' => 'Category is required',
            'blogDescription.required' => 'Description is required',
            'categoryName.required' => 'Category name is required',
        ];
    }

}
