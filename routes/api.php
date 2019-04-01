<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api\Painel',
    'prefix' => 'painel'
],
    function () {
        $this->get('senhas/chamarProximo','SenhaController@chamarProximo');
        $this->get('senhas/chamarNovamente','SenhaController@chamarNovamente');
        $this->apiResource('senhas','SenhaController');

        $this->apiResource('fila','FilaController');
        $this->apiResource('tipoSenhas','TipoSenhaController');
        $this->apiResource('guiches','GuicheController');
        $this->apiResource('especialidades','EspecialidadeController');
    });
