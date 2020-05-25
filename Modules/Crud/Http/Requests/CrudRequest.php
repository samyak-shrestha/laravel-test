<?php

namespace Modules\Crud\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Api\FormRequest;

class CrudRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    =>  'required|string|min:3',
            'last_name'     =>  'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'first_name is required!',
            'first_name.max' => 'first name should be greater than 3',
            'last_name.required' => 'please insert last name',
        ];
    }
}
