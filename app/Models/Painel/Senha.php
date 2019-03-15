<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    protected $fillable = [
        'numero',
        'id_tipo'
    ];

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

}
