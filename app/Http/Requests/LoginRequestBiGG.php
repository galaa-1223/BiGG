<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestBiGG extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:biggs',
            'password' => 'required'
        ];
    }
}
