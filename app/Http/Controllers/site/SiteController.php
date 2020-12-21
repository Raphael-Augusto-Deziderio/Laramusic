<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Models\painel\Album;
use App\Models\painel\Estilo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class SiteController extends Controller
{

    protected $album, $estilo;

    public function __construct(Album $album, Estilo $estilo){
        $this->album = $album;
        $this->estilo = $estilo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('');

        if(Session::has('theme')){
            $theme = session('theme');
        } else {
            $theme = 0;
        }

        //Recupera os albuns musicais
        $albuns =  $this->album->take(4)->orderBy('created_at', 'DESC')->get();


        //Recupera os estilos musicais
        $estilos =  $this->estilo->all();
        return view('site.home', compact('albuns', 'estilos', 'theme'));
    }

    public function tema(){

    }

    public function albunsEstilo($idEstilo)
    {
        //Recupera o estilo
        $estilo = $this->estilo->find($idEstilo);

        //Recuperar os albuns do estilo
        $albuns = $estilo->albuns()->get();

        return view('site.estilos.albuns', compact('albuns', 'estilo'));
    }

    public function albumPesquisar(Request $request)
    {
        //Recupera a palavra de pesquisa
        $palavraPesquisa = $request->get('pesquisa');

        //Recupera os albuns pela palavra de pesquisa
        $albuns = $this->album
            ->where('nome', 'LIKE', "%{$palavraPesquisa}%")
            ->get();
        return view('site.albuns.pesquisa', compact('albuns', 'palavraPesquisa'));
    }


    public function musicasAlbum($idAlbum)
{

    //Recupera o album pelo seu id
    $album = $this->album->find($idAlbum);

    //Recupera as músicas do album;
    $musicas = $album->musicas()->get();

    return view ('site.musicasPlayer', compact('album', 'musicas'));

}








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
