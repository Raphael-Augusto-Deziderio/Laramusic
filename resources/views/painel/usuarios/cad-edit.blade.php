@extends('painel.template-painel')

@section('content')



<div class="container">
    <br>
    <h1 class="title">
        Gestão de Usuários
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
        <form class="form" method="POST" action="{{$data->id}}">
    @else
    <form class="form" method="POST" action="{{url('painel/usuarios/cadastrar')}}">
    @endif
        {{csrf_field()}}
        <div class="form-group cad-edit">
            Nome:   <input type="text" name="nome" placeholder="Insira o Nome" class="form-control" value="{{$data->nome or  old('nome')}}">
        </div>

        <div class="form-group cad-edit">
            Email:   <input type="text" name="email" placeholder="Insira o Email" class="form-control" value="{{$data->email or  old('email')}}">
        </div>

        <div class="form-group cad-edit">
            Senha: <input type="password" name="password" placeholder="Insira a Senha" class="form-control" value="{{old('password')}}">
        </div>

        <br>

        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>

        </form>
</div>
@endsection