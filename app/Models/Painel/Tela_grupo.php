<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela_grupo extends Model
{
    protected $fillable = [
        'descricao'
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

    public function tipo(){
        return $this->hasOne(TipoSenha::class);
    }
}
