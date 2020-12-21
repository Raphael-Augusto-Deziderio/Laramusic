    @extends('painel.template-painel')

    @section('content')

    <!-- Filter and Actions-->
    <div class="actions">
        <div class="container">

            <form class="dashboard-form-search form form-inline" method="POST" action="/painel/albuns/{{$album->id}}/musicas/pesquisar">
                {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="encontrar" class="btn btn-success">
            </form>
        </div>
    </div> <!-- End Actions -->

    <div class="clear"></div>

    <div class="container">
        <br>
        <h1 class="title">
            Adicionar Novas Músicas ao Albúm <b>{{$album->nome}}</b>
        </h1>

        <br>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif


                <form class="form" method="POST" action="{{url("painel/albuns/{$album->id}/musicas/cadastrar")}}" enctype="multipart/form-data">
                {{csrf_field()}}

            @foreach($musicas as $musica)
            <div class="form-group cad-edit">

                <label>
                    <input type="checkbox" name="musicas[]" id="checkMusicas" value="{{$musica->id}}">
                    {{$musica->nome}}
                </label>

            </div>
            @endforeach


            <div class="form-group">
                <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
            </div>
        </form>


    </div>
    @endsection