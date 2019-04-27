<?php

namespace App\Models\Painel;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';

    protected $fillable = [
        'descricao',
        'ativo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function usuarios(){
        return $this->hasMany(User::class);
    }
}
