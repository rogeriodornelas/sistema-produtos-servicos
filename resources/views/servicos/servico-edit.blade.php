@extends('layouts.default')

@section('title', 'Editar Produto')

@section('content')
    <section class="mt-3">
        <h2>Edição de serviço</h2>

        <form class="mt-3 row" action="{{route('servicos.update', ['id'=>$servico->id])}}" id="servico-form" method="POST">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="nome">Nome do novo serviço</label>
                <input class="form-control" type="text" name="nome" id="nome" value="{{ $servico->nome }}">
            </div>
            <div>
                <label class="form-label">Produtos que compõem o serviço</label>
                <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                    @foreach ($produtosServico as $produtoServico)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $produtoServico->id }}">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $produtoServico->id }}" aria-expanded="false" aria-controls="collapse{{ $produtoServico->id }}">
                            {{ $produtoServico->nome }} <span class="badge text-bg-light">R$ {{ number_format($produtoServico->preco, 2) }}</span>
                          </button>
                        </h2>
                        <div id="collapse{{ $produtoServico->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $produtoServico->id }}" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            {{ $produtoServico->descricao }}
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="produto">Altere os produtos que compõem o serviço</label>
                <select class="form-select" name="produto_id[]" id="produto" multiple>
                    @foreach ($produtosAll as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label" for="descricao">Descrição do serviço</label>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5" form="servico-form">{{ $servico->descricao }}</textarea><br>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </section>        
@endsection
