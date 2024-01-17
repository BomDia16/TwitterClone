<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
            'usuario'   => 'required',
            'email'     => 'required|unique:users',
            'senha'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'O campo usuário é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
            'email.unique' => 'Esse email já está no nosso sistema!',
        ];
    }
}
