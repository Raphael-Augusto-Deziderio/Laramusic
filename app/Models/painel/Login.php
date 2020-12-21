<?php

namespace App\Models\painel;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

    protected $fillable = ['nome', 'password', 'tema'];

    static $rules = [
        'nome' => 'required',
        'password' => 'required'
    ];

    public function posts()
    {
       // return $this->belongsToMany('App\Post', 'users_posts', 'id_user', 'id_post');
        //return $this->belongsTo(Login::class);


    }
}
