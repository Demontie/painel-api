<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    protected $fillable = [
        'numero',
        'id_tipo',
        'id_sala'
    ];

    public function tipo(){
        return $this->belongsTo(Tipo::class,'id_tipo');
    }

    public function tela_sala(){
        return $this->belongsTo(Tela_sala::class,'sala_id');
    }

}
