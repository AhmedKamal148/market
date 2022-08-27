<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required|exists:clients,id',
        ];
    }
}
