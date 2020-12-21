@extends('painel.template-painel')

@section('content')


    @if(\Session::has('toastCad'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Cadastro Realizado com Sucesso'
            })

        </script>

    @elseif(\Session::has('toastEdt'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Edição Realizada com Sucesso'
            })

        </script>
    @elseif(\Session::has('toastDlt'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Remoção Realizada com Sucesso'
            })

        </script>
    @endif

    <!-- Filter and Actions-->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{url('/painel/usuarios/cadastrar')}}">
                <i class="fas fa-plus-circle"></i>
            </a>

            <form class="dashboard-form-search form form-inline" method="POST" action="/painel/usuarios/pesquisar">
                {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="encontrar" class="btn btn-success btnEncontrar">
            </form>
        </div>
    </div> <!-- End Actions -->

    <div class="clear"></div>


    <div class="container">
        <br>
        <h1 class="title">Lista de Usuários</h1>
        <table class="table table:hover">
            <tr class="table-painel">
                <th>Id:</th>
                <th>Nome:</th>
                <th>Email:</th>
                <th width="10%">Ações</th>
            </tr>

            @forelse($data as $usuario)
                <tr class="table-painel">
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nome}}</td>
                    <td>{{$usuario->email}}</td>

                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{url("/painel/usuarios/editar/$usuario->id")}}" class="edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <a href="{{url("/painel/usuarios/deletar/$usuario->id")}}" class="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </td>
            @empty
                <tr class="table-painel">
                    <td colspan="=90">Não Existem Usuários Cadastrados</td>

                </tr>
            @endforelse
        </table>


@endsection