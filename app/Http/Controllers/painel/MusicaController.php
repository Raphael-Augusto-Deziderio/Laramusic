<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\painel\Musica;
use Illuminate\Support\Facades\Storage;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Paginator;
use Builder;

class MusicaController extends StandardController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $model;
    protected $nameView = '/painel.musicas';
    protected $redirectCad = '/painel/musicas/cadastrar';
    protected $redirectEdit = '/painel/musicas/editar';
    protected $route =  '/painel/musicas';
    protected $request;


    public function __construct(Musica $musica, Request $request){

        $this->model = $musica;
        $this->request = $request;

    }

    //Faz o cadastro
    public function cadGo(){


        //Recupera os dados do formulario
        $dadosForm = $this->request->all();
        $musica = $this->request->file('arquivo');
        if($musica->getClientOriginalExtension() != "mp3"){
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Extensão não Permitida. Escolha um arquivo .MP3'])
                ->withInput();
        }




        //Valida os dados
        $validator = Validator::make($dadosForm, $this->model->rules);
        if($validator->fails()){
            return redirect($this->redirectCad)
                ->withErrors($validator)
                ->withInput();
        }

        //Upload do arquivo de imagem (Abaixo)

        //Recupera o campo de upload

        $originalName = $musica->getClientOriginalName();

        //Define o caminho
        $path = storage_path('app/public/painel/musicas/');


        //Define o nome da musica
        $nameMusic = date('YmdHms').'.'.$musica->getClientOriginalName();
        $dadosForm['arquivo'] = $nameMusic;

        //Faz o upload da musica
        $upload = $musica->move($path, $nameMusic);

        if(!$upload){
            return redirect ($this->redirectCad)
                ->with(['toastCad' => 'Upload realizado com sucesso'])
                ->withErrors(['errors => Falha ao fazer Upload']);
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

        $item = $this->model->find($id);
        $oldName = $item->arquivo;


        //Recupera o dados do formulário em forma de array
        $dadosForm = $this->request->all();
        $musica = $this->request->file('arquivo');

        if($musica->getClientOriginalExtension() != "mp3"){
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Extensão não Permitida. Escolha um arquivo .MP3'])
                ->withInput();
        }

        //Valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rulesEdit);
        if ($validator->fails()) {
            return redirect("$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }


        //Upload do arquivo de imagem (Abaixo)

        //Verificando se existe o arquivo para o upload e se é valido
        if ($this->request->hasFile('arquivo') && $this->request->file('arquivo')->isValid()) {


            //Recupera o campo de upload
            $musica = $this->request->file('arquivo');



            //Define o caminho
            $path = storage_path('app/public/painel/musicas/');
            $pathOldName = $path.$oldName;

            //Define o nome da musica
            $nameMusic = date('YmdHms') . '.' . $musica->getClientOriginalName();
            $dadosForm['arquivo'] = $nameMusic;

            $nomeArquivo = $musica->getClientOriginalName();


            //Faz o upload da musica
            $upload = $musica->move($path, $nameMusic);

            if (($upload) && $nomeArquivo != $oldName){
                File::delete($pathOldName);
            } else if (!$upload) {
                return redirect($this->redirectEdit)
                    ->withErrors(['errors => Falha ao fazer Upload']);
            }
        }


        //Faz a edição do item no DB
        $update = $item->update($dadosForm);


        //Verifica se editou com sucesso no DB
        if ($update) {
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
        $oldName = $item->arquivo;
        $path = storage_path('app/public/painel/musicas/');
        $pathOldName = $path.$oldName;

        //Deleta o item
        $delete = $item->delete();

        if ($delete) {
            File::delete($pathOldName);
            return redirect($this->route)
                ->with(['toastDlt' => 'Cadastro realizado com sucesso']);
        }

    }


}
