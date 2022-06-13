@extends('layouts.default')

@section('title', 'Produtos')

@section('content')
    <h1>Serviços</h1>
    <a href="{{ route('produtos.index') }}">Produtos</a>

    <section>
        <h2>Cadastro de um novo serviço</h2>
        @if ($errors->any)
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        @endif
        <form action="{{route('servicos.insert')}}" id="servico-form" method="POST">
            @csrf
            <input type="text" name="nome" placeholder="Nome do novo serviço">
            <select name="produto_id[]" id="produto" multiple>
                @foreach ($produtos as $produto)
                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                @endforeach
            </select>
            <br>
            <textarea name="descricao" cols="30" rows="10" form="servico-form">Descreva o produto...</textarea><br>
            <button type="submit">Cadastrar</button>
        </form>
        <br>
        <br>
        <h2>Serviços</h2>
        @foreach ($servicos->all() as $servico)
            <div>
                <hr>
                <h3>{{$servico->nome}}</h3>
                <p>Preço total: R$ {{number_format($servico->produtos()->sum('preco'), 2)}}</p>
                <p>{{$servico->descricao}}</p>
                <h4>Produtos relacionados</h4>
                @foreach ($servico->produtos as $produto)
                    <p>{{$produto->nome}} - R$ {{number_format($produto->preco, 2)}} - {{$produto->descricao}}</p>
                @endforeach
            </div>
        @endforeach
        
    </section>
@endsection
