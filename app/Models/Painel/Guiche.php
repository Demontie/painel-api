<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Guiche extends Model
{
    protected $fillable = [
        'descricao',
        'ativo',
        'grupo_tela_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senhas(){
        return $this->hasMany(Senha::class);
    }

    public function grupo_tela(){
        return $this->belongsTo(GrupoTela::class);
    }
}
