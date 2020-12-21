<!DOCTYPE html>
    <html class="ht-login">
        <head class="head-login">
            <meta charset="UTF-8">
            <title>Painel Laramusic </title>

            <!-- JQuery-->
            <script src="{{url('assets/js/jquery-3.5.1.min.js')}}"></script>


            <!-- Bootstrap CSS-->
            <link rel="stylesheet" href="{{url('/assets/css/bootstrap.css')}}">


            <!-- CSS -->
            <link rel="stylesheet" href="{{url('/assets/painel/css/laramusic-painel.css')}}">

            <!-- favicon -->
            <link rel="icon" type="image/png"  href="{{url('/assets/images/ImagensDashboard/favicon-laramusic.png')}}">

            <!-- Fonte Awesome-->
            <script src="{{url('https://kit.fontawesome.com/3399a6696c.js')}}" crossorigin="anonymous"></script>

            <!-- Sweet Alert-->
            <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
        </head>

        <body class="bg-login">


            <div class="clear"></div>


            <div class="login">
                <div class="login-header">
                    <a href="/">
                        <img src="{{url('/assets/images/ImagensDashboard/laramusic-branca.png')}}" class="logo-login">
                    </a>
                </div>

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
                        @elseif(\Session::has('logoutSucess'))
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
                            title: 'Logout Realizado com Sucesso'
                        })
                    </script>

                @endif
                @if(isset($errors) && count($errors) > 0)

                    <script>
                        Swal.fire(
                            'Erro',
                            '@foreach($errors->all() as $error)
                                    {{$error}}<br> @endforeach',
                            'error');
                    </script>



                @endif

                <form class="login form" action="login" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <p class="parag">Nome:</p>
                        <input type="text" name="nome" placeholder="Insira seu Nome" class="form-control" value="{{$data->nome or old('nome')}}">
                    </div>

                    <div class="form-group">
                        <p class="parag">Senha:</p>
                        <input type="password" name="password" placeholder="Insira sua Senha" class="form-control">
                    </div>

                    <div class="form-group cad-editLogin">
                        Selecione o Tema do Site:
                        <select name="tema" class="form-control">
                            <option value="0"> Claro</option>
                            <option value="1"> Escuro</option>
                        </select>
                    </div>



                    <div class="form-group">
                        <input type="submit" name="enviar" value="Entrar" class="btn btn-login">
                    </div>

                    <div class="form-group">
                        <a href="/">
                            <i class="fas fa-arrow-left btnVoltar-login"></i>
                        </a>
                    </div>

                    <div class="form-group text-right">
                       <a href="/login/recuperar-conta" class="recuperar">
                            Recuperar Senha
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


            <!-- Bootstrap JS-->
            <script src="{{url('assets/js/bootstrap.min.js') }}"></script>


        </body>
    </html>