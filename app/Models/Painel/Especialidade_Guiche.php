<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Especialidade_Guiche extends Model
{
    protected $fillable = [
        'guiche_id',
        'especialidade_id',
        'ativo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
