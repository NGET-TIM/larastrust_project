<?php

namespace App\Http\Requests\Category;

use DB;
use Illuminate\Support\Str;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       
        $category = Category::where('id', $this->id)->first();
        // if($category->code == $this->code) {
        //     return $this->rules();
        // }
        // if($category->name != $this->name) {
        //     return $this->rules();
        // }         
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
            'name' => [
                'required',
                'min:3',
                'max:255',
                'string',
                'unique:categories,name'
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Category :attribute field can not be blank value',
            'code.required' => 'The Category :attribute field is required',
            'code.alpha_dash' => 'The Category :attribute must only contain letters, numbers, dashes and underscores.',
            'code.unique' => 'The Category Code has already been taken.',
            'name.unique' => 'The Category Name has already been taken.',
        ];
    }
    
}
