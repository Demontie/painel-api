<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela_sala extends Model
{
    protected $fillable = [
        'sala_id_stg'
    ];

    public function sala(){
        return $this->hasOne(Sala::class,'id');
    }

    public function telas(){
        return $this->hasMany(Tela::class,'id_tela_salas');
    }

    public function senha(){
        return $this->hasMany(Senha::class,'id');
    }
}
