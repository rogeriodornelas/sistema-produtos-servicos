@extends('layouts.default')

@section('title', 'Editar Produto')

@section('content')
    <section class="mt-3">
        <h2>Edição de produto</h2>
        
        <form class="mt-3 row" action="{{route('produtos.update')}}" method="POST">
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
                <input class="form-control" type="text" name="nome" id="nome" value="{{$produto->nome}}">
            </div>
            <div class="col">
                <label class="form-label" for="number">Preço do produto</label>
                <input class="form-control" type="number" name="preco" id="preco" value="{{$produto->preco}}"><br>
            </div>
            <div>
                <label class="form-label" for="descricao">Descrição do produto</label>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5">{{$produto->descricao}}</textarea><br>
            </div>
            <button class="btn btn-primary" type="submit">Atualizar</button>
        </form>
    </section>
@endsection

