@extends('painel.template-painel')
@section('content')

    @if(\Session::has('loginSucess'))
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
                title: 'Login Realizado com Sucesso'
            });
        </script>

    @elseif(\Session::has('relatorio'))
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
                title: 'Relatório Gerado com Sucesso'
            });
        </script>
    @endif


    <div class="relatorios">
        <div class="container">
            <br>
            <div class="row">
                <div class="col-md-6 col-sm coluna">
                    <button type="button" id="relatorioPdf" class="btn-relatorioPdf btn-dark">Gerar Relatório - PDF</button>
                </div>


                <div class="col-md-6 col-sm coluna">
                    <button type="button" id="relatorioExcel" class="btn-relatorioExcel btn-dark">Gerar Relatório - Excel</button>
                </div>
            </div>



            <ul class="relatorios row">
                <li class="col-md-12 text-center">
                    <a  class="rel" href="{{url('/painel/estilos')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/estilos-laramusic.png')}}" alt="Estilos" class="img-relatorio">
                        <h2>{{$estilos}}</h2>
                    </a>
                </li>

                <li class="col-md-12 text-center">
                    <a href="{{url('/painel/albuns')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/albuns-laramusic.png')}}" alt="Albuns" class="img-relatorio">
                        <h2>{{$albuns}}</h2>
                    </a>
                </li>

                <li class="col-md-12 text-center">
                    <a href="{{url('/painel/musicas')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/music-laramusic.png')}}" alt="Musicas" class="img-relatorio">
                        <h2>{{$musicas}}</h2>
                    </a>
                </li>

                <li class="col-md-12 text-center">
                    <a href="{{url('/painel/usuarios')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/perfil-laramusic.png')}}" alt="Perfil" class="img-relatorio">
                        <h2>{{$usuarios}}</h2>
                    </a>
                </li>
            </ul>
        </div>
    </div> <!--End Relatorios-->


    <script>
        $("#relatorioPdf").click(function() {
            window.open('{{url('/painel/relatorio-pdf')}}');
        });

        $("#relatorioExcel").click(function() {
            window.open('{{url('/painel/relatorio-excel')}}');
        });
    </script>


@endsection