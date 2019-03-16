<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $fillable = [
        'id_tela_salas'
    ];

    public function tela_salas(){
        return $this->hasOne(Tela_sala::class, 'id_tela_salas');
    }
}
