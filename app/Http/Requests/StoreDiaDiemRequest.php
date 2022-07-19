<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiaDiemRequest extends FormRequest
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

            [
                'TenDiaDiem' => 'required|unique:dia_diems,TenDiaDiem',
            ],
            [
                'TenDiaDiem.required' => 'Bạn chưa nhập Email',
                'TenDiaDiem.unique' => 'Tên địa điểm đã tồn tại',
            ]
        ];
    }
}
