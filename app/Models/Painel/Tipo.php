<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = [
        'prefixo',
        'descricao'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function senha(){
        return $this->hasOne(Senha::class);
    }

    public function tela_grupo(){
        return $this->belongsTo(Tela_grupo::class);
    }
}
