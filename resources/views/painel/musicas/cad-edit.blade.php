@extends('painel.template-painel')

@section('content')



<div class="container">
    <br>
    <h1 class="title">
        Gestão de Músicas
    </h1>

    <br>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        </div>

    @endif

    @if(isset($data))
        <form class="form" method="POST" action="{{$data->id}}" enctype="multipart/form-data">
    @else
    <form class="form" method="POST" action="{{url('painel/musicas/cadastrar')}}" enctype="multipart/form-data">
    @endif
        {{csrf_field()}}
        <div class="form-group cad-edit">
            Nome:
            <input type="text" name="nome" placeholder="Insira o Nome da Música" class="form-control" value="{{$data->nome or old('nome')}}">
        </div>

        <div class="form-group cad-edit">
            Escolha a música:
            <input type="file" name="arquivo" accept="audio/*" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>

</div>
@endsection