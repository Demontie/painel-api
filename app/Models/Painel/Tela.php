<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $fillable = [
        'tela_salas_id',
        'descricao',
        'ativo',
        'grupo_tela_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function grupo_tela(){
        return $this->belongsTo(GrupoTela::class);
    }
}
