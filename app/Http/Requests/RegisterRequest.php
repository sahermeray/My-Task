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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required_without:phone|email|unique:users,email',
            'phone'=>'required_without:email|numeric|unique:users,phone',
            'first_name'=>'required',
            'last_name'=>'required',
            'password'=>'required|confirmed',
        ];
    }
}
