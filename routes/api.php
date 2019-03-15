<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api\Painel',
    'prefix' => 'painel'
],
    function () {
        $this->apiResource('senhas','SenhaController');
        $this->apiResource('fila','FilaController');
        $this->apiResource('tipos','TipoController');
    });
