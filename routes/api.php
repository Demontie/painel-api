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
            $this->get('senhasChamadas','SenhaController@getSenhasChamadas');
            $this->post('ultimaSenhaChamada','SenhaController@ultimaSenhaChamada');
            $this->put('atenderSenha','SenhaController@atenderSenha');
        });
        $this->apiResource('senhas','SenhaController');

        $this->apiResource('fila','FilaController');
        $this->apiResource('tipoSenhas','TipoSenhaController');
        /*
         * Guiches
         */
        $this->group([
            'prefix' => 'guiches'
        ],function (){
            $this->get('guichesDisponiveis','GuicheController@guichesDisponiveis');
        });
        $this->apiResource('guiches','GuicheController');

        $this->apiResource('especialidades','EspecialidadeController');
        $this->apiResource('grupoTelas','GrupoTelaController');
        $this->apiResource('grupoSalas','GrupoSalaController');
        $this->apiResource('telas','TelaController');
        $this->apiResource('salas','SalaController');
        $this->apiResource('perfis','PerfilController');

        $this->group([
            'prefix' => 'users'
        ],function (){
            $this->get('medicos','UserController@medicos');
        });
        $this->apiResource('users','UserController');

        $this->group([
            'prefix' => 'pacientes'
        ],function (){
            $this->post('pacientePorSenha','PacienteController@pacientePorSenha');
            $this->post('pacientePorMedico','PacienteController@pacientePorMedico');
            $this->post('proximoPaciente','PacienteController@proximoPaciente');
        });
        $this->apiResource('pacientes','PacienteController');

        $this->group([
            'prefix' => 'atendimentos'
        ],function (){
            $this->apiResource('atendimentos','AtendimentosController');
        });
        $this->apiResource('atendimentos','AtendimentosController');
    });

$this->group([
    'namespace' => 'Auth'
], function (){
    $this->post('autenticar','AutenticacaoController@autenticar');
    $this->get('getUsuarioAutenticado','AutenticacaoController@getUsuarioAutenticado');
    $this->post('cadastrarUsuario','AutenticacaoController@cadastrarUsuario');
});
