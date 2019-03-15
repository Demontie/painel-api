<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    public function tela_salas(){
        return $this->hasMany(Tela_sala::class);
    }
}
