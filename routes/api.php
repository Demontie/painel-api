<?php

use Illuminate\Http\Request;

$this->group([
    'namespace' => 'Api\Painel',
    'prefix' => 'painel'
],
    function () {
        $this->get('senhas/chamarProximo','SenhaController@chamarProximo');
        $this->get('senhas/chamarNovamente','SenhaController@chamarNovamente');
        $this->get('senhas/porPeriodo','SenhaController@getSenhasPorPeriodo');
        $this->apiResource('senhas','SenhaController');

        $this->apiResource('fila','FilaController');
        $this->apiResource('tipoSenhas','TipoSenhaController');
        $this->apiResource('guiches','GuicheController');
        $this->apiResource('especialidades','EspecialidadeController');
        $this->apiResource('telaGrupos','TelaGrupoController');
        $this->apiResource('telas','TelaController');
    });
