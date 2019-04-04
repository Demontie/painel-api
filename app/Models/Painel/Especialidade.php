<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $fillable = [
        'descricao',
        'procedimento_tuss_id',
        'ativo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
