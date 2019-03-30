<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Grupo_sala extends Model
{
    protected $fillable = [
        'sala_id',
        'tela_grupo_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senhas(){
        return $this->hasOne(Senha::class);
    }

    public function sala(){
        return $this->belongsTo(Sala::class);
    }

    public function tela_grupo(){
        return $this->belongsTo(Tela_grupo::class);
    }
}
