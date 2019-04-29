<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class GrupoTela extends Model
{
    protected $fillable = [
        'descricao',
        'ativo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function grupo_sala(){
        return $this->hasOne(Grupo_sala::class);
    }

    public function telas(){
        return $this->hasMany(Tela::class);
    }

    public function guiches(){
        return $this->hasMany(Guiche::class);
    }

    public function salas(){
        return $this->hasMany(Sala::class);
    }

    public function tipoSenha(){
        return $this->hasOne(TipoSenha::class);
    }
}
