<!DOCTYPE html>


<html>
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'Laramusic'}} </title>


    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap.css')}}">

    <!-- Fonts-->
    <script src="https://kit.fontawesome.com/3399a6696c.js" crossorigin="anonymous"></script>


    <!--CSS-->
    @if(\Session::has('theme'))
        @if (session('theme') == 0)
            <link rel="stylesheet" href="{{url('/assets/css/laramusic.css')}}">
        @elseif (session('theme') == 1)
            <link rel="stylesheet" href="{{url('/assets/css/laramusic-dark.css')}}">
        @endif
    @else
        <link rel="stylesheet" href="{{url('/assets/css/laramusic.css')}}">
@endif

<!-- favicon -->
    <link rel="icon" type="image/png" href="{{url('/assets/images/ImagensLaraMusic/favicon-laramusic.png')}}">

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <link href="{{url('assets/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')}}" rel="stylesheet"/>
    <script src="{{url('assets/lib/jquery.min.js')}}"></script>
    <script src="{{url('assets/dist/jplayer/jquery.jplayer.min.js')}}"></script>
    <script src="{{url('assets/dist/add-on/jplayer.playlist.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/assets/css/resets.css')}}">

    <!-- JQuery-->
    <script src="{{url('assets/js/jquery-3.5.1.min.js')}}"></script>

    <!-- JQUERY UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body class="bg">


@stack('scripts-header')

<header class="header">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 cc">
            <div class="row">
                <div class="col-md-3">
                    @if(\Session::has('theme'))
                        @if (session('theme') == 0)
                            <a href="/"> <img src="{{url('assets/Images/ImagensLaraMusic/laramusic.png')}}"
                                              alt="LaraMusic" title="LaraMusic" class="img-logo">
                            </a>
                        @else
                            <a href="/"> <img src="{{url('assets/Images/ImagensLaraMusic/laramusic-branca.png')}}"
                                              alt="LaraMusic" title="LaraMusic" class="img-logo">
                            </a>
                        @endif
                    @endif
                </div>

                <div class="col-md-4">
                    <form class="form-search" method="POST" action="/albuns/pesquisar">
                        {{csrf_field()}}
                        <input type="text" name="pesquisa" placeholder="Pesquisar Albúm" class="form-search-input">
                        <button class="btn-search">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="col-md-5">

                    <br><br>


                    <div class="row">
                        <div class="col-6">
                            <div width="100%" style="float: right;">
                                <a href="/tema/<?php
                                if (\Session::has('theme')) {
                                    if (session('theme') == 1) {
                                        echo '0';
                                    } else {
                                        echo '1';
                                    }
                                } else {
                                    echo '1';
                                }



                                ?>" class="tema">Mudar Tema</a>
                            </div>
                        </div>

                        <div class="col-6">
                            <div width="100%">
                                <a href="/login" class="entrar">Entrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class="col-md-2"></div>
    </div> <!-- End Div Row -->


</header><!-- End Header-->

<div class="clear">
    <br>
    <hr class="hr">
</div>

@yield('content')
@yield('jPlayer')

<div class="clear">
    <br>
    <hr class="hr">
    <footer class="footer">
        <div class="container text-center">

            <p class="text-footer"> CopyRight © Raphael TI - Todos os direitos reservados <?=date('Y')?> <br>
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
</div>


<!-- Bootstrap JS-->
<script src="{{url('assets/js/bootstrap.min.js') }}"></script>

<!-- SweetAlert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@stack('scripts-footer')

<script>
    $(document).ready(function () {

        $(".drag").addClass('ui-widget-content');
        $(".drag").draggable();

    });
</script>
</body>
</html>
