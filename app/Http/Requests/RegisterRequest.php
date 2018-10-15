<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|min:4|max:50|unique:users,username',
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'diachi' => 'required',
            'phone' => 'required|numeric|min:9',
            'checkbox' => 'required',
            
        ];
    }

}
