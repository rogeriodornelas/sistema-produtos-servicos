<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'produto_id' => 'required',
                'nome' => 'required|unique:servicos|max:255',
                'descricao' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'produto_id.required' => 'É preciso escolher ao menos um produto.',
            'nome.required' => 'É necessário definir um nome para o serviço',
            'nome.unique' => 'Já existe um serviço com este nome. Defina um nome único.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
        ];
    }
}