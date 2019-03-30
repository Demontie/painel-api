<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $fillable = [
        'tela_salas_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function tela_grupo(){
        return $this->belongsTo(Tela_grupo::class);
    }
}
