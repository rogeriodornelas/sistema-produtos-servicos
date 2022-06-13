<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Servico;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServicoController extends Controller
{
    public function index()
    {
        // $produtos = Produto::all();
        $produtos = DB::table('produtos')->select('id', 'nome')->get();
        $servicos = Servico::all();

        return view('servicos', compact('produtos', 'servicos'));
    }

    public function insert(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'produto_id' => 'required',
                'nome' => 'required|unique:servicos|max:255',
                'descricao' => 'nullable'
            ]);

            if ($request->produto_id == '') {
                throw new Exception('');
            }

            DB::transaction(function () use($validatedRequest) {
                $servico = Servico::create([
                    'nome' => $validatedRequest['nome'],
                    'descricao' => $validatedRequest['descricao'],
                ]);
        
                $idProdutos = $validatedRequest['produto_id'];
        
                $servico->produtos()->sync($idProdutos);
            });
                        
            return Redirect::route('servicos.index');

        } catch (Exception $e) {
            return response()->json(['mensage' => 'teste: '.$e->getMessage()]);
        }
    }
}
