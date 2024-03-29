<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategorieyType\CategorieyType;
use Illuminate\Foundation\Http\FormRequest;

class MainCategoriesRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required|in:1,2',
            'slug' => 'required|unique:categories,slug,' . $this->id,
        ];
    }
}