<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSupplier extends FormRequest
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
            's_name' => 'required',
            's_email' => 'required|unique:suppliers,s_email,'.$this->id,
            's_phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            's_name.required'  => 'Trường này không được để trống',
            's_email.required' => 'Trường này không được để trống',
            's_phone.required' => 'Trường này không được để trống',
            's_email.unique'   => 'Email đã tồn tại'
        ];
    }
}
