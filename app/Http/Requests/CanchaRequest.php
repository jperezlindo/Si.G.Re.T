<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanchaRequest extends FormRequest
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
            'cod'      => 'required|string|max:6|unique:canchas',
            'name'     => 'required|string|max:35|unique:canchas',
            'tipo'     => 'required|string',
            'ancho_cm' => 'required|numeric',
            'largo_cm' => 'required|numeric',
        ];
    }
}
