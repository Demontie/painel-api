<?php

namespace App\Models\Painel;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = [
        'paciente_id',
        'senha_id',
        'medico_id'
    ];

    public function medico(){
        return $this->belongsTo(User::class);
    }

    public function senha(){
        return $this->belongsTo(Senha::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
