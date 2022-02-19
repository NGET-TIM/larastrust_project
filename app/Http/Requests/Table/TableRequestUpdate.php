<?php

namespace App\Http\Requests\Table;

use Illuminate\Validation\Rule;
use App\Models\Table\TableModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TableRequestUpdate extends FormRequest
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
        $table = new TableModel();
        return [
            // 'code' => [
            //     'required',
            //     'min:3',
            //     'max:8',
            //     'alpha_dash',
            //     'email' => ['required', Rule::unique('users')->ignore($this->user)]
            // ],
            'code' => ['required', Rule::unique('table', 'code')->ignore($table->id)],
            // 'code' => [
            //     'required',
            //     Rule::unique('table', 'code')->ignore($this->table)
            // ],
            'name' => [
                'required',
                'min:4',
                'max:255',
                'string',
                Rule::unique('table')->ignore($this->table)
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The table :attribute field can not be blank value',
            'code.required' => 'The table :attribute field is required',
            'code.unique' => 'The table :attribute has already been taken',
            'name.unique' => 'The table :attribute has already been taken',
            'code.alpha_dash' => 'The table :attribute must only contain letters, numbers, dashes and underscores.',
        ];
    }
    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
