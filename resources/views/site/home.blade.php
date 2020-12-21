@extends('site.template')

@section('content')

    <section class="albuns">
        <div class="container">
            <h1 class="title"> Últimos Albúns:</h1>
            <div class="row">
                <div class="list-albuns col-md-12">
                    @forelse($albuns as $album)
                        <article class="col-md-3 album">
                            <a href="/albuns/{{$album->id}}">
                                <div class="image-albuns">
                                     <img src="{{url("res/public@painel@images@albuns@".$album->imagem)}}"
                                         alt="{{$album->nome}}" class="img-album">

                                </div>
                                <h1 class="title-album">{{$album->nome}}</h1>
                            </a>
                        </article>
                    @empty
                        <div class="col-md-12">
                            <p> Não Existem Albúns Cadastrados</p>
                        </div>
                    @endforelse

                </div><!-- End list-albuns-->
            </div>
        </div> <!-- End Div Container -->
    </section> <!-- End Albúns-->
    </div> <!-- End Clear-->

    <div class="clear">
        <br>
        <br>
        <hr class="hr">
        <section class="estilos">
            <div class="container">
                <h1 class="title">Estilos:</h1>

                <div class="estilos-mu col-md-12">
                    @forelse($estilos as $estilo)
                        <div class="coluna-estilos col-md-3">
                            <a href="{{url("/estilos/{$estilo->id}")}}" class="estilo">{{$estilo->nome}}</a>
                            <br>
                            @empty
                                <p>Não existem estilos cadastrados</p>
                            @endforelse
                        </div> <!--End Div estilos-mu-->
                </div> <!--End Div Container-->
        </section> <!--End Section Estilos-->
        <br>
        <br>
        <br><br>
        <br>
        <br><br>

    </div> <!-- End Clear-->
@endsection