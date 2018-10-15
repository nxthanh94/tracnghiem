<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangtinRequest extends FormRequest
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
            'hoten' => 'required',
            'diachi' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|min:9',
            'thoihan' => 'required',
            'city' => 'required',
            'price' => 'required|numeric',
            'dientich' => 'required|numeric',
            'title' => 'required|max:255',
            'hinhanh.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ];
    }

}
