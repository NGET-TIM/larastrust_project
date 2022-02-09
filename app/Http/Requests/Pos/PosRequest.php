<?php

namespace App\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
            'code' => [
                'required',
                'min:3',
                'max:8',
                'alpha_dash',
                'unique:categories,code'
            ],
            'customer' => [
                'required',
            ]
        ];
    }
    public function messages()
    {
        return [
            'customer.required' => 'Please, select customer before submit payment',
        ];
    }
}
