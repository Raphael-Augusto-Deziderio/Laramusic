<?php

namespace App\Models\painel;

use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
protected $fillable = ['nome'];

public $rules = [
    'nome' => 'required|min:3|max:100',
];

    public function albuns()
    {
        return $this->hasMany('App\Models\painel\Album', 'id_estilo');
    }

}
