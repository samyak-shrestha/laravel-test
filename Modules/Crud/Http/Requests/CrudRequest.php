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
            'firstName'    =>  'required',
            'lastName'     =>  'required',
            'image' => 'required|file|image|size:1024|dimensions:max_width=500,max_height=500',
            // 'image' => 'required|file|image|size:1024|dimensions:max_width=500,max_height=500',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function messages()
    {
        return [
            // 'firstName.required' => '<style style="color:red"> first name is required</style> ',
            'firstName.required' => 'first name is required',
            'lastName.required' => 'last name is required',
        ];
    }
}
