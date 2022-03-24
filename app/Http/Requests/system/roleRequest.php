<?php

namespace App\Http\Requests\system;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class roleRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $validate = [
            'permissions' => 'required',
        ];

        if ($request->method() == 'POST') {
            $validate = array_merge($validate, [
                'name' => 'required|unique:roles,name',
            ]);
        }
        if ($request->method() == 'PUT') {
            $validate = array_merge($validate, [
                'name' => 'required|unique:roles,name,'.$request->role,
            ]);
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'The role field is required.',
            'permissions.required' => 'Please select the permissions.',
        ];
    }
}
