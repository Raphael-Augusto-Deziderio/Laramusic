<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\painel\Estilo;
use App\Models\painel\Album;
use App\Models\painel\Musica;
use App\Models\painel\Login;
use App\User;
use DB;
use Auth;
use PDF;
use App;
use Excel;
class PainelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $estilo, $album, $musica, $usuario, $login, $request;

    public function __construct(Estilo $est, Album $alb, Musica $mus, User $usu, Login $log, Request $request)
    {
        $this->estilo = $est;
        $this->album = $alb;
        $this->musica = $mus;
        $this->usuario = $usu;
        $this->login = $log;
        $this->request = $request;
    }

    public function index()
    {

        //Recupera o total de cada item cadastrado
        $dadosForm = $this->request->all();

        $estilos =  $this->estilo->count();
        $albuns = $this->album->count();
        $musicas = $this->musica->count();
        $usuarios =  $this->usuario->count();
        $theme = session('theme');
        //$theme = Auth::user()->tema;
        //$theme = $this->login;
        //$theme = $this->login['tema'];



        return view('painel.home.home-painel', compact('estilos', 'albuns', 'musicas', 'usuarios', 'theme'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function relatorioPdf(){

        $estilos =$this->estilo->count();
        $albuns = $this->album->count();
        $musicas = $this->musica->count();
        $usuarios =  $this->usuario->count();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('painel.relatorioPdf', compact('estilos', 'albuns', 'musicas', 'usuarios')));
        return $pdf->stream();

    }

    public function relatorioExcel(){
        Excel::create('Relatório-LaraMusic', function ($excel) {


            $excel->sheet('Sheetname', function ($sheet) {
                $estilos =$this->estilo->count();
                $albuns = $this->album->count();
                $musicas = $this->musica->count();
                $usuarios =  $this->usuario->count();

                $dadosRelatorios = [$estilos, $albuns, $musicas, $usuarios];

                $sheet->loadView('painel.relatorioExcel', compact('dadosRelatorios', 'estilos', 'albuns', 'musicas', 'usuarios'));
                //dd('Hello1');
            });

        })->export('xls');
        //return view('painel.relatorioExcel');
    }

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
