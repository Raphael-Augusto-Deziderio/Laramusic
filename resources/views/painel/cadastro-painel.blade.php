@extends('painel.template-painel')

@section('content')

    <!-- Filter and Actions-->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{url('/painel/estilos/cadastrar')}}">
                <i class="fas fa-plus-circle"></i>
            </a>

            <form class="dashboard-form-search form form-inline">
                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" name="pesquisar" value="encontrar" class="btn btn-success">
            </form>
        </div>
    </div> <!-- End Actions -->

    <div class="clear"></div>




<div class="container">
    <br>
    <h1 class="title">
        Gestão de Usuário
    </h1>
    <form class="form">
        <div class="form-group">
            Nome:
            <input type="text" name="nome" placeholder="Insira o Nome" class="form-control">
        </div>

        <div class="form-group">
            Email:
            <input type="text" name="email" placeholder="Insira o Email" class="form-control">
        </div>

        <div class="form-group">
            Idade:
            <input type="text" name="idade" placeholder="Insira a Idade" class="form-control">
        </div>

        <div class="form-group">
            Telefone:
            <input type="text" name="telefone" placeholder="Insira o Telefone" class="form-control">
        </div>

        <div class="form-group">
            Senha:
            <input type="password" name="senha" placeholder="Insira a senha" class="form-control">
        </div>

        <div class="form-group">
            Confirme a Senha:
            <input type="confirm-password" name="confirma senha" placeholder="Confirme a senha" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>

</div>
@endsection