<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    protected $fillable = [
        'numero',
        'tipo_senha_id',
        'grupo_salas_id'
    ];

    public function tipo_senha(){
        return $this->belongsTo(TipoSenha::class);
    }

    public function grupo_sala(){
        return $this->belongsTo(Grupo_sala::class);
    }

}
