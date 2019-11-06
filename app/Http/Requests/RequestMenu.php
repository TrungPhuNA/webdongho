<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMenu extends FormRequest
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

    public function rules()
    {
        return [
            'm_name' => 'required|unique:menus,m_name,'.$this->id,
            // 'icon' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'm_name.required' => 'Trường này không được để trống',
            'm_name.unique'   => 'Tên menu đã tồn tại',
        ];
    }
}
