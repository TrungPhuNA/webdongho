<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'email'    => 'required|unique:admins,email,' . $this->id,
            'name'     => 'required',
            'phone'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Trường này không được để trống',
            'email.unique'      => 'Email đã tồn tại',
            'phone.required'    => 'Trường này không được để trống',
            'name.required'     => 'Trường này không được để trống'
        ];
    }
}
