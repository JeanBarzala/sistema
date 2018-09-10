<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTalonariosRequest extends FormRequest
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
            'serie_talon' => 'required',
            'nro_inicio_talon' => 'required',
            'fecha_vencimiento_talon' => 'required',
            'nro_final_talon' => 'required',
            'tipo_talon' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'serie_talon.required' => 'Debes completar la serie del talon.',
            'nro_inicio_talon.required' => 'Debes completar número de inicio del talon.',
            'fecha_vencimiento_talon.required' => 'Debes indicar una fecha de vencimiento para el talon.',
            'nro_final_talon.required' => 'Debes completar el número final del talon.',
            'tipo_talon.required' => 'Debes indicar un tipo de talon.'
        ];
    }
}
