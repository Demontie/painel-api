<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela_grupo extends Model
{
    protected $fillable = [
        'descricao'
    ];

    public function grupo_sala(){
        return $this->hasOne(Grupo_sala::class,'id_tela_grupo');
    }

    public function telas(){
        return $this->hasMany(Tela::class,'id_tela_grupo');
    }
}
