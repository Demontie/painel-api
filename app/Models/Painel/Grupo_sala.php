<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Grupo_sala extends Model
{
    protected $fillable = [
        'id_sala',
        'id_tela_grupo'
    ];

    public function senha(){
        return $this->hasMany(Senha::class,'id_grupo_sala');
    }

    public function sala(){
        return $this->hasOne(Sala::class,'id');
    }

    public function tela_grupo(){
        return $this->hasOne(Tela_grupo::class,'id');
    }
}
