    @extends('site.template')

    @section('content')

    <section class="albuns">

        <div class="container">

            <h1 class="title">Resultados para a pesquisa: {{$palavraPesquisa}}</h1>

            <div class="list-albuns col-md-12">
                <br>
                @forelse($albuns as $album)
                <article class="col-md-3 album">
                    <a href="/albuns/{{$album->id}}">
                        <div class="image-albuns">
                            <img src="{{url("res/public@painel@images@albuns@".$album->imagem)}}" alt="{{$album->nome}}" class="img-album">
                            <div class="hover-img-album">
                                <i class="fas fa-headphones"></i>
                            </div>
                        </div>
                        <h1 class="title-album">{{$album->nome}}</h1>
                    </a>
                </article>
                @empty
                    <div class="col-md-12">
                        <p>Não Existem Albúns para esta pesquisa</p>
                    </div>
                @endforelse
            </div><!-- End list-albuns-->
        </div>
    </section>
@endsection