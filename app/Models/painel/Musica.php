<?php

namespace App\Models\painel;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $fillable = ['nome', 'arquivo'];

    public $rules = [

        'nome' => 'required|min:3|max:100',
        'arquivo' => 'required|max:50000',
    ];

    public $rulesEdit = [
        'nome' => 'required|min:3|max:100',
        'arquivo' => 'max:50000',
    ];
}
