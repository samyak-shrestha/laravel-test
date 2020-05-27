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
            'first_name'    =>  'required',
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
            // 'first_name.required' => '<style style="color:red"> first name is required</style> ',
            'first_name.required' => 'first name is required',
            'last_name.required' => 'last name is required',
        ];
    }
}
