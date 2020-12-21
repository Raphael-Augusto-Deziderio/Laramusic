<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\painel\Estilo;
use Validator;
use Paginator;
use Builder;

class EstiloController extends StandardController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $model;
    protected $nameView = '/painel.estilos';
    protected $redirectCad = '/painel/estilos/cadastrar';
    protected $redirectEdit = '/painel/estilos/editar';
    protected $route =  '/painel/estilos';
    protected $request;


    public function __construct(Estilo $estilo, Request $request){

        $this->model = $estilo;
        $this->request = $request;

    }
}
