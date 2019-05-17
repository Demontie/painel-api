<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = [
        'paciente_id',
        'senha_id',
        'meidico_id'
    ];
}
