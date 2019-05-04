<?php

namespace App\Models\Painel;

use App\User;
use Illuminate\Database\Eloquent\Model;

class GuicheAtivo extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
