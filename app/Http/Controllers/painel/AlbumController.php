<?php

namespace App\Http\Controllers\painel;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\painel\Album;
use App\Models\painel\Estilo;
use App\Models\painel\Musica;
use Validator;
use Paginator;
use Builder;
use File;
use App\Http\Requests;

class AlbumController extends StandardController
{

    protected $model;
    protected $nameView = '/painel.albuns';
    protected $redirectCad = '/painel/albuns/cadastrar';
    protected $redirectEdit = '/painel/albuns/editar';
    protected $route =  '/painel/albuns';
    protected $request;


    public function __construct(Album $album, Request $request){

        $this->model = $album;
        $this->request = $request;


    }

    //Lista dos itens
    public function index()
    {
        //Recupera todos os estilos musicais cadastrados
      //  $data = $this->model->all();

        $data = $this->model
            ->join('estilos','estilos.id', '=', 'albuns.id_estilo')
            ->select('albuns.nome', 'albuns.id', 'estilos.nome as estilo')
            ->get();

        return view("{$this->nameView}.index", compact('data'));
    }


    public function cad(){
        //Recupera os estilos
        $estilos = Estilo::get();

        return view("{$this->nameView}.cad-edit", compact('estilos'));
    }

    //Faz o cadastro
    public function cadGo(){


        //Recupera os dados do formulario
        $dadosForm = $this->request->all();
        $imagem = $this->request->file('imagem');




        //Valida os dados
        $validator = Validator::make($dadosForm, $this->model->rules);
        if($validator->fails()){
            return redirect($this->redirectCad)
                ->withErrors($validator)
                ->withInput();
        }

        //Upload do arquivo de imagem (Abaixo)

        //Recupera o campo de upload

        $originalName = $imagem->getClientOriginalName();

        //Define o caminho
        $path = storage_path('app/public/painel/images/albuns');


        //Define o nome da imagem
        $nameImagem = date('YmdHms').'.'.$imagem->getClientOriginalName();
        $dadosForm['imagem'] = $nameImagem;

        //Faz o upload da imagem
        $upload = $imagem->move($path, $nameImagem);

        if(!$upload){
            return redirect ($this->redirectCad)
                ->withErrors(['errors => Falha ao fazer Upload']);
        }

        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if ($insert){
            return redirect("painel/albuns/{$insert->id}/musicas/cadastrar");
        } else {
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
        }
    }



    public function edit($id)
    {
        //Recupera o item pelo Id
        $data = $this->model->find($id);

        $estilos = Estilo::get();
        return view("{$this->nameView}.cad-edit", compact('data','estilos'));

    }

    public function editGo($id)
    {

        $item = $this->model->find($id);
        $oldName = $item->imagem;


        //Recupera o dados do formulário em forma de array
        $dadosForm = $this->request->all();
        $imagem = $this->request->file('imagem');





        //Valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rulesEdit);
        if ($validator->fails()) {
            return redirect("$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }


        //Upload do arquivo de imagem (Abaixo)

        //Verificando se existe o arquivo para o upload e se é valido
        if ($this->request->hasFile('imagem') && $this->request->file('imagem')->isValid()) {


            //Recupera o campo de upload
            $imagem = $this->request->file('imagem');



            //Define o caminho
            $path = storage_path('app/public/painel/images/albuns/');
            $pathOldName = $path.$oldName;

            //Define o nome da imagem
            $nameImagem = date('YmdHms') . '.' . $imagem->getClientOriginalName() . '.' . $imagem->getClientOriginalExtension();
            $dadosForm['imagem'] = $nameImagem;

            $nomeImagem = $imagem->getClientOriginalName();


            //Faz o upload da imagem
            $upload = $imagem->move($path, $nameImagem);

            if (($upload) && $nomeImagem != $oldName){
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
        $oldName = $item->imagem;
        $path = storage_path('app/public/painel/images/albuns/');
        $pathOldName = $path.$oldName;

        //Deleta o item
        $delete = $item->delete();

        if ($delete) {
            File::delete($pathOldName);
            return redirect($this->route)
                ->with(['toastDlt' => 'Remoção realizada com sucesso']);
        }

    }

    //Faz a pesquisa
    public function pesquisar()
    {
        //Recupera a palvra pesquisada
        $pesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra pesquisada
        //$data = $this->model->where('nome', 'LIKE', "%$pesquisa%")->get();

        $data = $this->model
            ->join('estilos','estilos.id', '=', 'albuns.id_estilo')
            ->select('albuns.nome', 'albuns.id', 'estilos.nome as estilo')
            ->where('albuns.nome', 'LIKE', "%$pesquisa%")
            ->orWhere('estilos.nome', 'LIKE', "%$pesquisa%")
            ->get();

        //Mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }

    public function musicas($id)
    {
        //Recupera o album
        $album = $this->model->find($id);

        //Recupera as músicas do album
        $musicas = $album->musicas;

        return view('painel.albuns.musicas', compact('musicas', 'album'));
    }

    public function musicasCadastrar($id, Musica $musica)
    {
        //Recupera o album
        $album = $this->model->find($id);


        //recupera as musicas
        $musicas = $musica->whereNotIn('id', function ($query) use ($id){
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw("albuns_musicas.id_album = {$id}");
        })
        ->get();

        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'))
            ->with(['toastDlt' => 'Remoção realizada com sucesso']);
    }

    public function musicasCadastrarGo($id)
    {
        //Recupera as musicas
        $musicas = $this->request->get('musicas');

        //Recupera o album
        $album = $this->model->find($id);


        //Valida os dados antes de editar
        $validator = Validator::make($this->request->all(), $this->model->rulesVincMusic);
        if ($validator->fails()) {
            return redirect("painel/albuns/{$id}/musicas/cadastrar")
                ->withErrors($validator)
                ->withInput();
        }

        //Vincula as músicas ao album
        $vincula = $album->musicas()->attach($musicas);

        return redirect("painel/albuns/musicas/{$id}")
            ->with(['toastCad' => 'Cadastro realizado com sucesso']);
    }

    public function deletarMusicaAlbum($idAlbum, $idMusica)
    {
        //Recupera  album pelo seu id
        $album = $this->model->find($idAlbum);

        //Recupera o objeto de musicas albuns
        $musicas = $album->musicas()->detach($idMusica);

        return redirect("painel/albuns/musicas/{$idAlbum}")
            ->with(['toastDlt' => 'Remoção realizada com sucesso']);;

    }

    public function musicaPesquisar($id)
    {

        //Recupera o album
        $album = $this->model->find($id);

        //Recupera as músicas do album
        $musicas = $album
                ->musicas()
                ->where('musicas.nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
                ->get();

        return view('painel.albuns.musicas', compact('musicas', 'album'));
    }

    public function pesquisarMusicaAdd($id, Musica $musica)
    {

        //Recupera o album
        $album = $this->model->find($id);


        //recupera as musicas
        $musicas = $musica->whereNotIn('id', function ($query) use ($id){
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw("albuns_musicas.id_album = {$id}");
        })
            ->where('nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
            ->get();

        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'));
    }
}
