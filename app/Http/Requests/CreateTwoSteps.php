<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTwoSteps extends FormRequest
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
    // . array(CategorieyType::mainCategory, CategorieyType::subCategory),
    public function rules()
    {
        return [
            'price' => 'required',
            'special_price' => 'required',
            'special_price_type' => 'required',
            'special_price_start' => 'required',
            'special_price_end' => 'required',

        ];
    }
}