<?php


namespace App\Classes\Utils;


class CamposConsultasPainel
{
    public function tipos(){
        return [
            'id',
            'descricao',
            'prefixo'
        ];
    }

    public function grupoSala(){
        return [
            'id',
            'descricao',
            'ativo'
        ];
    }

    public function grupoSalaTelaGrupo(){
        return [
            'id',
            'sala_id',
            'tela_grupo_id',
            'ativo'
        ];
    }

    public function grupoSalasTelaGrupoTelas(){
        return [
            'id',
            'descricao',
            'tela_grupo_id'
        ];
    }

    public function grupoSalasSala(){
        return [
            'id',
            'descricao',
            'sala_id_stg',
            'ativo'
        ];
    }

}