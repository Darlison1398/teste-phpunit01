<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes,email,' . $this->route('id'),
            'telefone' => 'nullable|string|max:20',
        ];
    }
}
