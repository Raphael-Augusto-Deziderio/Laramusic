<?php
/**
 * Created by PhpStorm.
 * User: rdeziderio
 * Date: 03/12/2020
 * Time: 12:44
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;

class StandardController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;



    //Lista dos itens
    public function index()
    {
        //Recupera todos os estilos musicais cadastrados
        $data = $this->model->all();

        return view("{$this->nameView}.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Exibe o formulário de cadastro
    public function cad(){

        return view("{$this->nameView}.cad-edit");
    }


    //Faz o cadastro
    public function cadGo(){

        //Recupera os dados do formulario
        $dadosForm = $this->request->all();

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


    //Exibe o formulario de edição
    public function edit($id)
    {
        //Recupera o item pelo Id

        $data = $this->model->find($id);

        return view("{$this->nameView}.cad-edit", compact('data'));

    }


    //Edita o item
    public function editGo($id)
    {
        //Recupera o dados do formulário em forma de array
        $dadosForm = $this->request->all();

        //Valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rules);
        if($validator->fails()){
            return redirect("$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }


        //Recupera o item pelo Id
        $item = $this->model->find($id);

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



    public function deleteGo($id)
    {
        //Recupera o item pelo id
        $item = $this->model->find($id);

        //Deleta o item
        $delete = $item->delete();

        if ($delete) {
            return redirect($this->route)
                ->with(['toastDlt' => 'Remoção realizado com sucesso']);
        }

    }

    //Faz a pesquisa
    public function pesquisar()
    {
        //Recupera a palvra pesquisada
        $pesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra pesquisada
        $data = $this->model->where('nome', 'LIKE', "%$pesquisa%")->get();

        //Mostra a view
        return view("{$this->nameView}.index", compact('data'));
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
