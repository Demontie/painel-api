<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'descricao',
        'sala_id_stg',
        'ativo',
        'grupo_tela_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

//    public function grupo_sala(){
//        return $this->belongsTo(Grupo_sala::class);
//    }

    public function grupo_tela(){
        return $this->belongsTo(GrupoTela::class);
    }
}
