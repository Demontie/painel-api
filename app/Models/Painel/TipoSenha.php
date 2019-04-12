<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class TipoSenha extends Model
{
    protected $fillable = [
        'prefixo',
        'descricao',
        'grupo_tela_id',
        'cor',
        'tamanho_botao',
        'ordem',
        'ativo',
        'regra',
        'prioridade'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senha(){
        return $this->hasOne(Senha::class);
    }

    public function grupo_tela(){
        return $this->belongsTo(GrupoTela::class);
    }
}
