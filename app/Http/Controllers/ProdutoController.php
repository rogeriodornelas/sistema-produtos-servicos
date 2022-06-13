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

        return view('produtos', compact('produtos'));
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

        return Redirect::route('produtos.index');

        } catch (Exception $e) {
            return dd($e);
        }

    }
}
