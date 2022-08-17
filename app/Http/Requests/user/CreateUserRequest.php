<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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


    public function rules()
    {
        return [
            'first_name'            =>       'required|min:4',
            'last_name'             =>       'required|min:4',
            'email'                 =>       'required|unique:users,email',
            'password'              =>       'required|confirmed',
            'image'                 =>        'image',

        ];
    }
}
