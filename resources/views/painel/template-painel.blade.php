<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Dashboard Laramusic'}} </title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap.css')}}">

    <!-- CSS -->
    @if(\Session::has('themePainel'))
        @if (session('themePainel') == 0)
            <link rel="stylesheet" href="{{url('/assets/painel/css/laramusic-painel.css')}}">

            <!-- Sweet Alert-->
            <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal/minimal.css" rel="stylesheet">


        @elseif (session('themePainel') == 1)
            <link rel="stylesheet" href="{{url('/assets/painel/css/laramusic-painel-dark.css')}}">

            <!-- Sweet Alert-->
            <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        @endif
    @else
        <link rel="stylesheet" href="{{url('/assets/painel/css/laramusic-painel.css')}}">
    @endif

    <!-- favicon -->
    <link rel="icon" type="image/png"  href="{{url('/assets/images/ImagensDashboard/favicon-laramusic.png')}}">

    <!-- Fonte Awesome-->
    <script src="{{url('https://kit.fontawesome.com/3399a6696c.js')}}" crossorigin="anonymous"></script>

    <!-- JQuery-->
    <script src="{{url('assets/js/jquery-3.5.1.min.js')}}"></script>

    <!-- Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>


<body class="bg-painel">
<div class="menu">
    <div class="row">
        <ul class="menu col-md-12">
            <div class="row">
                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel')}}" class="a-menu">
                        <img src="{{url('/assets/images/ImagensDashboard/laramusic-branca.png')}}" alt="LaraMusic" class="logo">
                    </a>
                </li>

                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel/estilos')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/estilos-laramusic.png')}}" alt="Estilos" class="img-menu">
                        <h2>Estilos</h2>
                    </a>
                </li>

                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel/albuns')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/albuns-laramusic.png')}}" alt="Albuns" class="img-menu">
                        <h2>Albúns</h2>
                    </a>
                </li>

                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel/musicas')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/music-laramusic.png')}}" alt="Musicas" class="img-menu">
                        <h2>Músicas</h2>
                    </a>
                </li>

                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel/usuarios')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/perfil-laramusic.png')}}" alt="Perfil" class="img-menu">
                        <h2>Usuários</h2>
                    </a>
                </li>

                <li class="col-md-2 text-center">
                    <a class="focos" href="{{url('/painel/logout')}}">
                        <img src="{{url('/assets/images/ImagensDashboard/sair-laramusic.png')}}" alt="Sair" class="img-menu">
                        <h2>Sair</h2>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</div>






@yield('content')

<div class="clear"></div>

        <footer class="footer">
            <div class="container text-center">

                <p class="text-footer"> CopyRight © Raphael TI - Todos os direitos reservados <?=date('Y')?>  <br>
                    CNPJ: XX.XXX.XXX/XXXXXX-XX <br>
                    Raphael Augusto Malaquias Deziderio - xxxxx@xxxx.com
                </p>
                <div class="social">
                    <a href="https://www.instagram.com/raphael13augusto/" target="_blank">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                </div>

            </div><!--End Div Container-->
        </footer><!--End Footer-->


<!-- Bootstrap JS-->
<script src="{{url('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>