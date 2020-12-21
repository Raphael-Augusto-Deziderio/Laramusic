<?php

namespace App\Models\painel;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albuns';

    protected $fillable = ['id_estilo', 'nome', 'imagem'];

    public $rules = [
        'id_estilo' => 'required',
        'nome' => 'required|min:3|max:100',
        'imagem' => 'required|image|min:3|max:10000|mimes:jpg,png,jpeg',
    ];

    public $rulesEdit = [
        'id_estilo' => 'required',
        'nome' => 'required|min:3|max:100',
        'imagem' => 'image|min:3|max:10000|mimes:jpg,png,jpeg',
    ];

    public $rulesVincMusic = [
        'musicas' => 'required'
    ];

    public function musicas()
    {
        return $this->belongsToMany('App\Models\painel\Musica', 'albuns_musicas', 'id_album', 'id_musica');
    }
}
