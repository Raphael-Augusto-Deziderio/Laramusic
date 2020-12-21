@extends('painel.template-painel')

@section('content')



<div class="container">
    <br>
    <h1 class="title">
        Gestão de Albuns
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
    <form class="form" method="POST" action="{{url('painel/albuns/cadastrar')}}" enctype="multipart/form-data">
    @endif



        {{csrf_field()}}
        <div class="form-group cad-edit">
            Estilo:
            <select name="id_estilo" class="form-controll">
            <option value=" ">Escolha o Estilo:</option>

            @foreach($estilos as $estilo)
                <option value="{{$estilo->id}}"
                    @if(isset($data->id_estilo) && $data->id_estilo == $estilo->id)
                        selected
                    @endif
                >{{$estilo->nome}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group cad-edit">
            Nome:
            <input type="text" name="nome" placeholder="Insira o Nome do Album" class="form-control" value="{{$data->nome or old('nome')}}">
        </div>

        <div class="form-group cad-edit">
            Imagem:
            <input type="file" name="imagem" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>

</div>
@endsection