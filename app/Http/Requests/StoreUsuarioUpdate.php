<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioUpdate extends FormRequest
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
            'name' => 'required|min:2',
            'motherlastname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->usuario),
            ],
            'phone' => 'required|min:10',
        ];
    }
}
