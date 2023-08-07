<?php

namespace App\Http\Requests\system;

use Illuminate\Foundation\Http\FormRequest;

class ticketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'user_id' => 'required',      
            'description'=>'required'
        ];
    }
}
