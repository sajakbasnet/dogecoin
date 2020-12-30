<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\checkClientSecret;
use App\Rules\Api\checkClienttId;
use App\Rules\Api\checkUserExists;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
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
        return [
            "client_id" => ['required', new checkClienttId],
            "client_secret" => ['required', new checkClientSecret($request->client_id)],
            "grant_type" => 'required|in:password,refresh_token',
            "refresh_token" => 'requiredIf:grant_type,refresh_token',
            "email" => ['requiredIf:grant_type,password', new checkUserExists($request->password)],
            "password" => 'requiredIf:grant_type,password'
        ];
    }
}
