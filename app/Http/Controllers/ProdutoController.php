<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('produtos.produtos', compact('produtos'));
    }
    
    public function insert(Request $request)
    {
        $validatedRequest = $request->validate([
            'nome' => 'required|unique:produtos|max:255',
            'descricao' => 'nullable',
            'preco' => 'required|numeric'
        ]);

        try {     
        DB::transaction(function () use($validatedRequest) {
            Produto::create($validatedRequest);            
        });

        return Redirect::route('produtos.index')->with('message', "Produto {$validatedRequest['nome']} criado com sucesso!");

        } catch (Exception $e) {
            return dd($e);
        }
    }

    public function delete($id)
    {
        $produtoDeleted = Produto::find($id);

        try {
            DB::transaction(function () use($produtoDeleted) {
                $produtoDeleted->servicos()->detach();
                $produtoDeleted->delete();
            });

            return Redirect::route('produtos.index')->with('message', "Produto {$produtoDeleted->nome} deletado com sucesso.");
        } catch (Exception $e) {
            return dd($e);
        }
    }
}
