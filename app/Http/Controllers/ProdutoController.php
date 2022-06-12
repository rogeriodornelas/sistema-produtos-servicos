<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('produtos', compact('produtos'));
    }
    
    public function insert(Request $request)
    {
        $validatedRequest = $request->validate([
            'nome' => 'required|unique:produtos|max:255',
            'descricao' => 'nullable',
            'preco' => 'required|numeric'
        ]);

        Produto::create($validatedRequest);

        return Redirect::route('produtos.index');
    }
}
