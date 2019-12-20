<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email'    => 'required|unique:users,email,' . $this->id,
            'name'     => 'required|max:180',
            'password' => 'required|max:180',
            'phone'    => 'required|max:180',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Trường này không được để trống',
            'email.unique'      => 'Email đã tồn tại',
            'name.required'     => 'Trường này không được để trống',
            'phone.required'    => 'Trường này không được để trống',
            'password.required' => 'Trường này không được để trống',
        ];
    }
}
