<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Grupo_sala extends Model
{
    protected $fillable = [
        'sala_id',
        'grupo_tela_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senhas(){
        return $this->hasMany(Senha::class);
    }

    public function salas(){
        return $this->hasMany(Sala::class);
    }

    public function grupo_tela(){
        return $this->belongsTo(GrupoTela::class);
    }
}
