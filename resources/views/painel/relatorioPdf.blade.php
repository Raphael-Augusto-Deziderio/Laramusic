<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório Laramusic</title>
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{url('/assets/css/bootstrap.css')}}">
    </head>

    <body>

     <h1 class="text-center">Relatório - Quantidade de Cadastros</h1>


     <hr>
    <div class="container">
            <div class="form-group">
                {{'Estilos Cadastrados: '.$estilos}}
            </div>


            <div class="form-group">
                {{'Albúns Cadastrados: '.$albuns}}
            </div>


            <div class="form-group">
                {{'Músicas Cadastradas: '.$musicas}}
            </div>


            <div class="form-group">
                {{'Usuários Cadastrados: '.$usuarios}}
            </div>
    </div>
    </body>
</html>