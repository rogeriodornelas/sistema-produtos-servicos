@extends('layouts.default')

@section('title', 'Editar Produto')

@section('content')
    <section class="mt-3">
        <h2>Edição de serviço</h2>

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
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="nome">Nome do novo serviço</label>
                <input class="form-control" type="text" name="nome" id="nome" value="{{ $servico->nome }}">
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
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5" form="servico-form">Descreva o serviço...</textarea><br>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </section>        
@endsection
