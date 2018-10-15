<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuexeRequest extends FormRequest
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
            'name' => 'required|max:100',
            'name_vn' => 'required|max:100',
            'gia' => 'required|numeric|string:20',
            'chongoi' => 'required|numeric|string:11',
            'mau' => 'required|max:100',
            'mau_vn' => 'required|max:100',
            'thoigian' => 'required|max:100',
            'mota' => 'required|max:255',
            'mota_vn' => 'required|max:255',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'tieude' => 'max:255',
            'tukhoa' => 'max:255',
            'mo_ta' => 'max:255',
            
        ];
    }

}
