@extends('layouts.default')

@section('title', 'Produtos')

@section('content')
    <section class="mt-3">
        <h2>Cadastro de um novo serviço</h2>

        <form class="mt-3 row" action="{{route('servicos.insert')}}" id="servico-form" method="POST">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nome">Nome do novo serviço</label>
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome do novo serviço"  value="{{ old('nome') }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="produto">Selecione os produtos que compõem esse serviço</label>
                <select class="form-select" name="produto_id[]" id="produto" multiple>
                    @foreach ($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label" for="descricao">Descrição do serviço</label>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5" form="servico-form">Descreva o produto...</textarea><br>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </section>

    <section class="mt-5">
        <h2>Serviços</h2>
        <hr>
        <div class="row row-cols-2">
        @foreach ($servicos->all() as $servico)
            <div class="col">
                <div class="card shadow-sm m-3 col">
                    <div class="card-body">
                        <h4>{{$servico->nome}}</h4>
                        <span class="badge bg-success">R$ {{number_format($servico->produtos()->sum('preco'), 2)}}</span>
                        <p class="mt-3">{{$servico->descricao}}</p>
                        <div class="card">
                            <h5 class="card-header">Produtos relacionados</h5>
                            <ul class="list-group list-group-flush">
                                @if ($servico->produtos->count())
                                    @foreach ($servico->produtos as $produto)
                                        <li class="list-group-item">
                                            {{$produto->nome}} <span class="badge text-bg-light">R$ {{number_format($produto->preco, 2)}}</span>
                                            {{-- {{$produto->descricao}} --}}
                                        </li>
                                    @endforeach

                                    @else
                                    <li class="list-group-item">Nenhum produto associado</li>
                                @endif
                            </ul>
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-light" href="{{ route('servicos.edit', ['id' => $servico->id]) }}">Editar</a>
                            <a class="btn btn-light" href="{{ route('servicos.delete', ['id' => $servico->id]) }}">Deletar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </section>
        
@endsection
