<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    protected $fillable = [
        'numero',
        'tipo_senha_id',
        'grupo_salas_id',
        'guiche_id',
        'ativo',
        'status',
        'quantidade_chamada'
    ];

    public function tipo_senha(){
        return $this->belongsTo(TipoSenha::class);
    }

    public function grupo_sala(){
        return $this->belongsTo(Grupo_sala::class);
    }

    public function guiche(){
        return $this->belongsTo(Guiche::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function atendimento(){
        return $this->hasOne(Atendimento::class);
    }
}
