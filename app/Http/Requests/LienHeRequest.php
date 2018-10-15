<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LienHeRequest extends FormRequest
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
            'name' => 'required|min:10|max:100',
            'email' => 'required|email|max:50|regex:/^[a-z0-9]+[_a-z0-9.-]*[a-z0-9]+@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/',
            'phone' => 'required|min:10|numeric',
            'noidung' => 'required',
            'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ];
    }

}
