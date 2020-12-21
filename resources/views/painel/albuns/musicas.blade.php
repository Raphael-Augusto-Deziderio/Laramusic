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
            <a class="add" href="{{url("/painel/albuns/{$album->id}/musicas/cadastrar")}}">
                <i class="fas fa-plus-circle"></i>
            </a>

            <form class="dashboard-form-search form form-inline" method="POST" action="/painel/albuns/musicas/{{$album->id}}">
             {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="encontrar" class="btn btn-success">
            </form>
        </div>
    </div> <!-- End Actions -->

    <div class="clear"></div>


    <div class="container">
        <br>
        <h1 class="title">Lista das Músicas do Albúm <b>{{$album->nome}}</b> </h1>
        <table class="table table:hover">
            <tr class="table-painel">
                <th>Id:</th>
                <th>Nome:</th>
                <th>Ações</th>
            </tr>

            @forelse($musicas as $musica)
                <tr class="table-painel">
                    <td>{{$musica->id}}</td>
                    <td>{{$musica->nome}}</td>
                    <td>

                        <a href="{{url("/painel/albuns/$album->id/musicas/deletar/$musica->id")}}" class="delete">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                @empty
                <tr class="table-painel">
                    <td colspan="=90">Não Existem Musicas neste albúm</td>

                </tr>
            @endforelse
        </table>
    </div>
@endsection