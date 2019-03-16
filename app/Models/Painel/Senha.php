<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    protected $fillable = [
        'numero',
        'id_tipo',
        'sala_id_stg'
    ];

    public function tipo(){
        return $this->hasMany(Tipo::class,'id');
    }

    public function tela_sala(){
        return $this->hasMany(Tela_sala::class,'id');
    }

}
