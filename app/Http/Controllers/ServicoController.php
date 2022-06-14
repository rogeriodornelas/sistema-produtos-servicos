<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoPostRequest;
use App\Models\Servico;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServicoController extends Controller
{
    public function index()
    {
        $produtos = DB::table('produtos')->select('id', 'nome')->get();
        $servicos = Servico::all();

        return view('servicos.servicos', compact('produtos', 'servicos'));
    }

    public function insert(ServicoPostRequest $request)
    {
        $validatedRequest = $request->validated();

        try {
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
                        
            return Redirect::route('servicos.index')->with('message', "Serviço {$validatedRequest['nome']} criado com sucesso!");

        } catch (Exception $e) {
            return response()->json(['mensage' => 'teste: '.$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $servicoDeleted = Servico::find($id);

            DB::transaction(function () use($servicoDeleted) {
                $servicoDeleted->produtos()->detach();
                $servicoDeleted->delete();
            });
            
            return Redirect::route('servicos.index')->with('message', "Serviço {$servicoDeleted->nome} deletado com sucesso");
            
        } catch (Exception $e) {
            // dd('deu erro', $e, $servicoDeleted);
            return Redirect::route('servicos.index')->with('message', "Serviço {$servicoDeleted->nome} não foi deletado");
        }

    }
}
