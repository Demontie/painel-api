<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'descricao',
        'ativo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senhas(){
        return $this->hasMany(Senha::class);
    }
}
