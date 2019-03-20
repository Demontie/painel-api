<?php


namespace App\Classes\Utils;


class Status_Senha
{
    public static function AGUARDANDO_CHAMADA(){
        return 1;
    }
    public static function CHAMADA_RECEPCAO(){
        return 2;
    }
    public static function CHAMADA_MEDICO(){
        return 3;
    }
}