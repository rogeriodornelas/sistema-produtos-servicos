<!doctype html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('site/style.css')}}">
    <title>@yield('title', 'Título Padrão')</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <h1 class="col">Produtos e Serviços</h1>
            
            <div class="d-flex justify-content-end col">
                <a class="btn btn-outline-success me-2" role="button" href="{{ route('produtos.index') }}">Produtos</a>
                <a class="btn btn-outline-success me-2" role="button" href="{{ route('servicos.index') }}">Serviços</a>
            </div>
        </div>
    </nav>


    <div class="container">
        @yield('content')
    </div>

    <script src="{{asset('site/bootstrap.js')}}"></script>
</body>
</html>
