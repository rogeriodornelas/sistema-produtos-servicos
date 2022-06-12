<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServicoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $servicos = Servico::all();

        return view('servicos', compact('produtos', 'servicos'));
    }

    public function insert(Request $request)
    {
        $validatedRequest = $request->validate([
            'produto_id' => 'required',
            'nome' => 'required|unique:servicos|max:255',
            'descricao' => 'nullable'
        ]);

        $servico = Servico::create([
            'nome' => $validatedRequest['nome'],
            'descricao' => $validatedRequest['descricao'],
        ]);

        $idProdutos = $validatedRequest['produto_id'];

        $servico->produtos()->sync($idProdutos);

        return Redirect::route('servicos.index');
    }
}
