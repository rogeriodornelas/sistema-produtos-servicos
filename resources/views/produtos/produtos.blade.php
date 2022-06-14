@extends('layouts.default')

@section('title', 'Produtos')

@section('content')
    <section class="mt-3">
        <h2>Cadastro de um novo produto</h2>
        
        <form class="mt-3 row" action="{{route('produtos.insert')}}" method="POST">
            @csrf
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif
            <div class="col">
                <label class="form-label" for="nome">Nome do produto</label>
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome do novo produto" value="{{old('nome')}}">
            </div>
            <div class="col">
                <label class="form-label" for="number">Preço do produto</label>
                <input class="form-control" type="number" name="preco" id="preco" placeholder="Preço do novo produto" value="{{old('preco')}}"><br>
            </div>
            <div>
                <label class="form-label" for="descricao">Descrição do produto</label>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5" placeholder="Descreva o novo produto..."></textarea><br>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </section>
    
    <section class="mt-5">
        <h2>Produtos</h2>
        <hr>
        <div class="row row-cols-3">
        @foreach ($produtos as $produto)
            <div class="col">
                <div class="card shadow-sm m-3 col">
                    <div class="card-body">
                        <h4>{{$produto->nome}}</h4>
                        <span class="badge bg-success">R$ {{number_format($produto->preco, 2)}}</span>
                        <p class="mt-3">{{$produto->descricao}}</p>
                        <div class="mt-3">
                            <a class="btn btn-warning" href="{{'produtos/delete/'.$produto->id}}">Deletar</a>
                            <a class="btn btn-primary" href="{{'produtos/edit/'.$produto->id}}">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </section>
@endsection

