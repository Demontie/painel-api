<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Guiche extends Model
{
    public function senhas(){
        return $this->hasMany(Senha::class);
    }
}
