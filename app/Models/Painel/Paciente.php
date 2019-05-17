<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'senha_id'
    ];

    public function senhas(){
        return $this->hasMany(Senha::class);
    }

}
