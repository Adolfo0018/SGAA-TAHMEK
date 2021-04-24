<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibroPost extends FormRequest
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
            'titulo' => 'required|min:5|max:100',
            'descripcion' => 'required|min:10|max:3000',
            'autor' => 'required|min:5|max:100',
            'disponible' => 'required',
            'ejemplares' => 'required',
            'estante' => 'required',
            'fila' => 'required'
        ];
    }
}
