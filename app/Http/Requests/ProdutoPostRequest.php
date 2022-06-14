<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoPostRequest extends FormRequest
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
            'nome' => 'required|unique:produtos|max:255',
            'descricao' => 'nullable',
            'preco' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'É preciso preencher o nome do produto.',
            'nome.unique' => 'O nome do produto está sendo utilizado.',
            'nome.max' => 'O nome do produto precisa ter no máximo 255 caracteres.',
            'preco.required' => 'O preço precisa ser preenchido com um número.',
            'preco.numeric' => 'O preço precisa ser um número.'
        ];
    }
}
