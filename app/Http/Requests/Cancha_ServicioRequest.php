<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cancha_ServicioRequest extends FormRequest
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
            'cancha_id'     => 'required',
            'servicio_id'   => 'required',
            'precio'        => 'required',
            'requerido'     => 'required',
        ];
    }
}
