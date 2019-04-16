<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api\Painel',
    'prefix' => 'painel'
],
    function () {
        $this->group([
            'prefix' => 'senhas'
        ],function (){
            $this->put('chamarProximo','SenhaController@chamarProximo');
            $this->put('chamarNovamente','SenhaController@chamarNovamente');
            $this->get('porPeriodo','SenhaController@getSenhasPorPeriodo');
        });
        $this->apiResource('senhas','SenhaController');

        $this->apiResource('fila','FilaController');
        $this->apiResource('tipoSenhas','TipoSenhaController');
        $this->apiResource('guiches','GuicheController');
        $this->apiResource('especialidades','EspecialidadeController');
        $this->apiResource('grupoTelas','GrupoTelaController');
        $this->apiResource('telas','TelaController');
    });
