<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhongRequest extends FormRequest
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
            'name_vn' => 'required|max:100',
            'diachi' => 'required|max:200',
            'thoihan' => 'required',
            'id_list' => 'required',
            'id_list3' => 'required',
            'id_list4' => 'required',
            'dientich' => 'required|numeric|string:100',
            'gia' => 'required|numeric|string:100',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'tieude' => 'max:255',
            'tukhoa' => 'max:255',
            'mo_ta' => 'max:255',
            
            
        ];
    }

}
