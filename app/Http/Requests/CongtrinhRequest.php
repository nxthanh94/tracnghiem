<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CongtrinhRequest extends FormRequest
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
            'name_en' => 'required|max:100',
            'mota_en' => 'required|max:255',
            'name_vn' => 'required|max:100',
            'mota_vn' => 'required|max:255',
            'tieude' => 'max:255',
            'tukhoa' => 'max:255',
            'mo_ta' => 'max:255',
            'chitiet_vn' => 'required',
            'chitiet_en' => 'required',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ];
    }

}
