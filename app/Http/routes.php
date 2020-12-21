<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/estilos', function () {
    return view('site.estilo');
});

Route::get('/estilos/albuns/musicas', function () {
    return view('site.musicasPlayer');

});


Route::get('/res/{filename}', function ($filename = null) {
    if (isset($filename)) {
        if (Storage::exists(str_replace('@', '/', $filename))) {
            return Storage::disk('local')->get(str_replace('@', '/', $filename));
        } else {
            return Storage::disk('local')->get('public/painel/images/placeholder.png');
        }
    } else {
        return Storage::disk('local')->get('public/painel/images/placeholder.png');
    }
});


    //Gestão do Dashboard
    Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'painel'], function () {

        Route::get('/','painel\PainelController@index');

       Route::get('/relatorio-pdf', 'painel\PainelController@relatorioPdf');
       Route::get('/relatorio-excel', 'painel\PainelController@relatorioExcel');


        //Lista de Usuarios
        Route::get('/usuarios', 'painel\LoginController@usuarios');


        //Estilos Controller
        Route::get('/estilos', 'painel\EstiloController@index');

        Route::get('/estilos/cadastrar', 'painel\EstiloController@cad');
        Route::post('estilos/cadastrar', 'painel\EstiloController@cadGo');

        Route::get('/estilos/editar/{id}', 'painel\EstiloController@edit');
        Route::post('/estilos/editar/{id}', 'painel\EstiloController@editGo');

        Route::get('/estilos/deletar/{id}', 'painel\EstiloController@deleteGo');

        Route::post('/estilos/pesquisar', 'painel\EstiloController@pesquisar');


        //Albuns Controller
        Route::get('/albuns', 'painel\AlbumController@index');

        Route::get('/albuns/cadastrar', 'painel\AlbumController@cad');
        Route::post('albuns/cadastrar', 'painel\AlbumController@cadGo');

        Route::get('/albuns/editar/{id}', 'painel\AlbumController@edit');
        Route::post('/albuns/editar/{id}', 'painel\AlbumController@editGo');

        Route::get('/albuns/deletar/{id}', 'painel\AlbumController@deleteGo');

        Route::post('/albuns/pesquisar', 'painel\AlbumController@pesquisar');


        //Musicas Controller
        Route::get('/musicas', 'painel\MusicaController@index');

        Route::get('/musicas/cadastrar', 'painel\MusicaController@cad');
        Route::post('musicas/cadastrar', 'painel\MusicaController@cadGo');

        Route::get('/musicas/editar/{id}', 'painel\MusicaController@edit');
        Route::post('/musicas/editar/{id}', 'painel\MusicaController@editGo');

        Route::get('/musicas/deletar/{id}', 'painel\MusicaController@deleteGo');

        Route::post('/musicas/pesquisar', 'painel\MusicaController@pesquisar');


        //Login Controller
        Route::get('/usuarios/cadastrar', 'painel\LoginController@cadastroUsuario');
        Route::post('/usuarios/cadastrar', 'painel\LoginController@validarCadUsuario');


        //Usuarios Controller
        Route::get('/usuarios', 'painel\UsuarioController@index');

        Route::get('/usuarios/cadastrar', 'painel\UsuarioController@cad');
        Route::post('usuarios/cadastrar', 'painel\UsuarioController@cadGo');

        Route::get('/usuarios/editar/{id}', 'painel\UsuarioController@edit');
        Route::post('/usuarios/editar/{id}', 'painel\UsuarioController@editGo');

        Route::get('/usuarios/deletar/{id}', 'painel\UsuarioController@deleteGo');

        Route::post('/usuarios/pesquisar', 'painel\UsuarioController@pesquisar');


        //Albuns <-> Musicas
        Route::get('albuns/musicas/{id}', 'painel\AlbumController@musicas');
        Route::get('albuns/{id}/musicas/cadastrar', 'painel\AlbumController@musicasCadastrar');
        Route::post('albuns/{id}/musicas/cadastrar', 'painel\AlbumController@musicasCadastrarGo');
        Route::get('albuns/{idAlbum}/musicas/deletar/{idMusica}', 'painel\AlbumController@deletarMusicaAlbum');
        Route::post('albuns/musicas/{id}', 'painel\AlbumController@musicaPesquisar');
        Route::post('albuns/{id}/musicas/pesquisar', 'painel\AlbumController@pesquisarMusicaAdd');
        //Logout
        Route::get('/logout', 'painel\LoginController@doLogout');

    });







});

//Login Controller
    Route::get('/login', 'painel\LoginController@showLogin');
    Route::get('/login/recuperar-conta', 'painel\LoginController@mostraEmail');
    Route::post('/login/recuperar-conta/email', 'painel\LoginController@verificaEmail');
    Route::post('/login/recuperar-conta/email/codigo', 'painel\LoginController@verificaCodigo');
    Route::post('/login/recuperar-conta/email/codigo/senha', 'painel\LoginController@recuperarSenha');
    Route::post('/login', 'painel\LoginController@doLogin');


Route::get('/recuperar-conta', function () {
    return view('painel.recuperar-conta');
});

Route::get('/recuperar-senha', function () {
    return view('painel.recuperar-senha');
});


//Mostra as musicas do album
Route::get('albuns/{id}', 'site\SiteController@musicasAlbum');

//Filtra o album
Route::post('albuns/pesquisar', 'site\SiteController@albumPesquisar');


//Listagem dos albuns de um determinado estilo musical
Route::get('estilos/{id}', 'site\SiteController@albunsEstilo');




//Home Page do Laramusic
Route::get('/tema/{theme}', function($theme = null){
    if(isset($theme)){
        \Session::put('theme', $theme);
    }
    return redirect()->back();
});

Route::get('/','site\SiteController@index');


