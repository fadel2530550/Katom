<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Groups extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $rules = [
                'name' => 'required|unique:groups|string|min:2|max:150',
                'duration' => 'required|numeric|min:0',
                'price' => 'float|min:0',
                'category_id' => 'required|int',
                'type_parent_id' => 'required|int'
            ]
        ];
    }
}
