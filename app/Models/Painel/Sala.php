<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'descricao',
        'sala_id_stg',
        'ativo'
    ];

    public function grupo_sala(){
        return $this->hasOne(Grupo_sala::class,'grupo_tela_id');
    }
}
