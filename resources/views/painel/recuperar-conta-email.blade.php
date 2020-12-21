
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel Laramusic </title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap.css')}}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{url('/assets/painel/css/laramusic-painel.css')}}">

    <!-- favicon -->
    <link rel="icon" type="image/png"  href="{{url('/assets/images/ImagensDashboard/favicon-laramusic.png')}}">

    <!-- Fonte Awesome-->
    <script src="https://kit.fontawesome.com/3399a6696c.js" crossorigin="anonymous"></script>

</head>


<body>

<div class="clear"></div>



<div class="login">
    <div class="login-header">
        <a href="/">
            <img src="{{url('/assets/images/ImagensDashboard/laramusic-branca.png')}}" class="logo-login">
        </a>
    </div>

    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        </div>
    @endif


    <form class="login form" action="/login/recuperar-conta/email" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <p class="parag">Email:</p>
            <input type="text" name="email" placeholder="Insira seu Email" class="form-control">
        </div>


        <div class="form-group">
            <input type="submit" name="recuperar" value="Recuperar" class="btn btn-login">
        </div>

        <div class="form-group">
            <a href="/">
                <i class="fas fa-arrow-left voltar-recuperar-email"></i>
            </a>
        </div>

        <div class="form-group text-right">
            <a href="/login" class="entrar">
                Entrar
            </a>
        </div>

    </form>
</div>


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
<!-- JQuery-->
<script src="{{url('assets/js/jquery-3.5.1.min.js')}}"></script>

<!-- Bootstrap JS-->
<script src="{{url('assets/js/bootstrap.min.js') }}"></script>

<!-- SweetAlert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>