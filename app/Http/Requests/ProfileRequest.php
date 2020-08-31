<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
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
            'name'=>'required',
            'email'=>'required|email|unique:admins,email,' .$this -> id,
            'password'=>'nullable|confirmed|min:8',

        ];
    }

    public function messages(){
        return [
//            'value.required'=> __('message.required'),
//            'email.email'=> __('message.email'),
//            'plain_value.required'=> __('message.required'),
//            'plain_value.nullable'=> __('message.nullable'),




        ];

    }
}
