<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\User;
use Validator;
use Paginator;
use Builder;

class UsuarioController extends StandardController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $model;
    protected $nameView = '/painel.usuarios';
    protected $redirectCad = '/painel/usuarios/cadastrar';
    protected $redirectEdit = '/painel/usuarios/editar/{id}';
    protected $route =  '/painel/usuarios';
    protected $request;


    public function __construct(User $usuarios, Request $request){

        $this->model = $usuarios;
        $this->request = $request;

    }

    public function cadGo(){

        //Recupera os dados do formulario
        $dadosForm = $this->request->all();

        //encrypto a senha
        $Password = $this->request->input('password');
        $encPassword = bcrypt($Password);
        $dadosForm['password'] = $encPassword;

        //Valida os dados
        $validator = Validator::make($dadosForm, $this->model->rules);
        if($validator->fails()){
            return redirect($this->redirectCad)
                ->withErrors($validator)
                ->withInput();
        }

        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if ($insert){
            return redirect($this->route)
                ->with(['toastCad' => 'Cadastro realizado com sucesso']);
        } else {
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
        }
    }


    public function editGo($id)
    {
        //Recupera o dados do formulário em forma de array
        $dadosForm = $this->request->all();

        //encrypto a senha
        $Password = $this->request->input('password');
        $encPassword = bcrypt($Password);
        $dadosForm['password'] = $encPassword;

        //Valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rules);
        if($validator->fails()){
            return redirect("$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }


        //Recupera o item pelo Id
        $item = $this->model->find($id);

        if(count($dadosForm['password']) > 0){
            $dadosForm['password'] = $encPassword;
        } else {
            unset($dadosForm['password']);
        }


        //Faz a edição do item no DB
        $update = $item->update($dadosForm);

        //Verifica se editou com sucesso
        if ($update){
            return redirect($this->route)
                ->with(['toastEdt' => 'Edição realizada com sucesso']);
        } else {
            return redirect("$this->redirectEdit/$id")
                ->withErrors(['errors' => 'Falha ao Editar'])
                ->withInput();
        }

    }


}
