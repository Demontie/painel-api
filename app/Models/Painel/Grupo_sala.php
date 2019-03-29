<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Grupo_sala extends Model
{
    protected $fillable = [
        'sala_id',
        'tela_grupo_id'
    ];

    public function senhas(){
        return $this->hasOne(Senha::class);
    }

    public function tipos(){
        return $this->hasOne(Tipo::class);
    }

    public function sala(){
        return $this->belongsTo(Sala::class);
    }

    public function tela_grupo(){
        return $this->belongsTo(Tela_grupo::class);
    }
}
