<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre_producto' => 'required',
            'precio_producto' => 'required',
            'stock_actual' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre_producto.required' => 'Debes completar el nombre del comproducto.',
            'precio_producto.required' => 'Debes completar el precio del producto.',
            'stock_actual.required' => 'Debes indicar un stock inicial para el producto.'
        ];
    }
}
