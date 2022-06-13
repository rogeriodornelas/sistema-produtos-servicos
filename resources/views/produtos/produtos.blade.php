@extends('layouts.default')

@section('title', 'Produtos')

@section('content')
    <h1>Produtos</h1>
    <a href="{{ route('servicos.index') }}">Serviços</a>

    <section>
        <h2>Cadastro de um novo produto</h2>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
        @endif
        <form action="{{route('produtos.insert')}}" method="POST">
            @csrf
            <input type="text" name="nome" placeholder="Nome do novo produto" value="{{old('nome')}}">
            <input type="number" name="preco" placeholder="Preço do novo produto" value="{{old('preco')}}"><br>
            <textarea name="descricao" cols="30" rows="10" placeholder="Descreva o novo produto..."></textarea><br>
            <button type="submit">Cadastrar</button>
        </form>
        <br>
        <br>
        <h2>Produtos</h2>
        @foreach ($produtos as $produto)
            <div>
                <hr>
                <h3>{{$produto->nome}}</h3>
                <p>Preço: R$ {{number_format($produto->preco, 2)}}</p>
                <p>{{$produto->descricao}}</p>
            </div>
        @endforeach
    </section>
@endsection

