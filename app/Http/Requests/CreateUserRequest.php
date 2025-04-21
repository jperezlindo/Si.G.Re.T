<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user'             => 'required|string|unique:users',
            'dni'              => 'required|min:7|max:8|unique:users',
            'apellido'         => 'required|string',
            'name'             => 'numeric',
            'name'             => 'required|string',
            'email'            => 'required|email|unique:users',
            'fecha_nacimiento' => 'required',
            'password'         => 'required|string|min:6|confirmed',
            'foto'             => 'image',
        ];
    }
}
