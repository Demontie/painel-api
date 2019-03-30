<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api\Painel',
    'prefix' => 'painel'
],
    function () {
        $this->get('senhas/chamarProximo','SenhaController@chamarProximo');
        $this->apiResource('senhas','SenhaController');

        $this->apiResource('fila','FilaController');
        $this->apiResource('tipos','TipoController');
        $this->apiResource('guiches','GuicheController');
        $this->apiResource('especialidades','EspecialidadeController');
    });
