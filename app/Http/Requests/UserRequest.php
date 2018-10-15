<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'min:6',
            'name' => 'required',
            'email' => 'required|email',
            'diachi' => 'required',
            'sdt' => 'required|numeric',
            
        ];
    }

    public function messages()
    {
        return [
        'username.required' => 'Vui lòng nhập Username',
        'username.min' => 'Tên Username tối thiểu 4 kí tự ',
        'username.max' => 'Tên Username tối đa 50 kí tự ',
        'username.unique' => 'Tên Username đã tồn tại ',
        ////////////////////////////////////////////////
        'password.min' => 'password tối thiểu 6 kí tự ',


        'name.required' => 'Vui lòng nhập họ và tên ',

        'email.required' => 'Vui lòng nhập email ',
        'email.email' => 'Email không đúng định dạng',
        
        'diachi.required' => 'Vui lòng nhập địa chỉ',

        'sdt.required' => 'Vui lòng nhập số điện thoại ',
        'sdt.numeric' => 'Vui lòng nhập số ',

        ];
    }
}
