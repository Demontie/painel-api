<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela_sala extends Model
{
    protected $fillable = [
        'sala_id',
        'id_tela'
    ];

    public function salas(){
        return $this->belongsTo(Sala::class,'sala_id');
    }

    public function telas(){
        return $this->belongsTo(Tela::class,'id_tela');
    }
}
