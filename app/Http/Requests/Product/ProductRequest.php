<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => [
                'required'
            ],
            'weight' => [
                'nullable',
                'numeric',
            ],
            'code' => [
                'required',
                'alpha_dash',
                'unique:products,code',
                'min:8',
                'max:8',
            ],
            'category_id' => [
                'required',
            ],
            'cost' => [
                'nullable',
                'numeric',
            ],
            'price' => [
                'required',
                'numeric',
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The product :attribute field can not be blank value',
            'code.required' => 'The product :attribute field is required',
            'code.alpha_dash' => 'The product :attribute must only contain letters, numbers, dashes and underscores.',
            'code.unique' => 'Product Code has already been taken',
            'category_id.required' => 'The product category need to select one.',
            'cost.numeric' => 'The product cost must be a number.',
            'price.numeric' => 'The product cost must be a number.',
            'price.required' => 'The product :attribute field is required.',
        ];
    }
}
