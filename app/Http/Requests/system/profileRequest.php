<?php

namespace App\Http\Requests\system;

use App\Rules\system\checkOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
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
            'old_password' => ['required', new checkOldPassword],
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }
}
