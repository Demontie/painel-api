<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = [
        'prefixo',
        'descricao'
    ];

    public function senhas(){
        return $this->hasOne(Senha::class);
    }
}
