<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TorneoCreateRequest extends FormRequest
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
            'name'     		=> 'string|min:4|max:35|required|unique:torneos',
            'f_desde'  		=> 'required',
            'f_hasta'       => 'required',
            'ini_ins'       => 'required',
            'fin_ins'     	=> 'required',
            'descripcion'   => 'required',
        ];
    }
}