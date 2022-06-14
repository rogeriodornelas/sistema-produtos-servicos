<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoPostRequest;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('produtos.produtos', compact('produtos'));
    }
    
    public function insert(ProdutoPostRequest $request)
    {
        $validatedRequest = $request->validated();

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

    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produtos.produto-edit', compact('produto'));
    }

    public function update(ProdutoPostRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        $produto = Produto::find($id);

        try {
            DB::transaction(function () use($produto, $validatedRequest){
                $produto->update($validatedRequest);
            });
        } catch (Exception $e) {
            dd($produto);
        }
        
        return Redirect::route('produtos.index')->with('message', "Produto {$produto->nome} atualizado com sucesso.");
    }
}
