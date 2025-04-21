<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'name'          => 'required|string',
            'razon_social'  => 'required|string', 
            'cuit'          => 'required', 
            'email'         => 'required|email', 
            'direccion'     => 'required', 
            'rubro'         => 'required',  
            'ciudad_id'     => 'required',
            'logo'          => 'image',
        ];
    }
}
