<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,' . $this->id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            //'is_active' => 'required|in:1,0',
            'categories' => 'array|min:1',
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable|array|min:1',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|min:0|numeric',

            'special_price' => 'nullable|numeric',
            'special_price_type' => 'required_with:special_price|in:fixed,percent',
            'special_price_start' => 'required_with:special_price|date_format:Y-m-d',
            'special_price_end' => 'required_with:special_price|date_format:Y-m-d',
            'sku' => 'nullable|min:3|max:10',

            'manage_stock' => 'required|in:0,1',
            'in_stock' => 'required|in:0,1',
            //     //'qty' => 'required_if:manage_stock,==,1',
            //     //'qty'  => [new ProductQty($this->manage_stock)],
            //     'document' => 'required|array|min:1',
            //     'document.*' => 'required|string',

        ];
    }
}