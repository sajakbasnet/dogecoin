<?php

namespace App\Http\Requests\system;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class userRequest extends FormRequest
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
        $data = [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $request->user,
            'email' => 'required|email|unique:users,email,' . $request->user,
            'role_id' => 'required'
        ];

        if ($request->set_password_status == 1) {
            $data = array_merge($data, [
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ]);
        }
        return $data;
    }
}
