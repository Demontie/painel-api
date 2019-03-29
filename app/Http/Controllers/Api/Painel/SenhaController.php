<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\ConstantesPainel;
use App\Models\Painel\Senha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenhaController extends Controller
{
    protected $senha;
    private $constantesPainel;

    public function __construct(Senha $senha,
                                ConstantesPainel $constantesPainel)
    {
        $this->senha = $senha;
        $this->constantesPainel = $constantesPainel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senhas = $this->senha
            ->where('status',$this->constantesPainel::AGUARDANDO_CHAMADA)
            ->where('ativo',true)
            ->with([
                'tipo'=>  function($query){
                    $query->select($this->tipos());
                },
                'grupo_sala' => function($query){
                    $query->select($this->grupoSalaTelaGrupo());
                },
                'grupo_sala.tela_grupo' => function($query){
                    $query->select($this->grupoSala());
                },
                'grupo_sala.tela_grupo.telas' => function($query){
                    $query->select($this->grupoSalasTelaGrupoTelas());
                },
                'grupo_sala.sala' => function($query){
                    $query->select($this->grupoSalasSala());
                },
            ])
            //->whereDate('created_at',date('Y-m-d'))
            ->orderBy('id','desc')
            ->take(5)
            ->get();

        return response()->json($senhas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ultimaSenha = $this->senha
            ->where('tipo_id',$request['tipo_id'])
            ->orderBy('id','desc')->first();

        $numero = is_null($ultimaSenha) || ($ultimaSenha->numero == $this->constantesPainel::LIMITE_SENHAS) ? 1 : $ultimaSenha->numero + 1;

        $novaSenha = array_merge([
            'numero' => str_pad($numero,3,'0',STR_PAD_LEFT)
        ],$request->all());

        $senha = $this->senha->create($novaSenha);

        return response()->json($senha,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $senha = $this->senha
            ->with([
                'tipo'=>  function($query){
                    $query->select($this->tipos());
                },
                'grupo_sala' => function($query){
                    $query->select($this->grupoSalaTelaGrupo());
                },
                'grupo_sala.tela_grupo' => function($query){
                    $query->select($this->grupoSala());
                },
                'grupo_sala.tela_grupo.telas' => function($query){
                    $query->select($this->grupoSalasTelaGrupoTelas());
                },
                'grupo_sala.sala' => function($query){
                    $query->select($this->grupoSalasSala());
                },
            ])->find($id);

        if(is_null($senha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }

        return response()->json($senha);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $senha = $this->senha->find($id);

        if(is_null($senha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }
        $senha->update($request->all());
        return response()->json($senha);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $senha = $this->senha->find($id);

        if(is_null($senha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }

        $senha->update([
            'ativo' => true,
            'status' => $this->constantesPainel::CANCELADA
        ]);

        return response()->json([],204);
    }

    /**
     * Chama a senha com base no id do guiche que chamou
     *
     * @param Request $request
     * @return string
     */
    public function chamarNovamente(Request $request){
        $ultimaSenha = $this->senha
            ->where('ativo',true)
            ->where('guiche_id',$request['guiche_id'])
            ->where('status',$this->constantesPainel::CHAMADA_RECEPCAO)
            ->with([
                'tipo',
                'grupo_sala.tela_grupo.telas',
                'grupo_sala.sala',
            ])
            ->orderBy('id', 'desc')
            ->first();

        if(is_null($ultimaSenha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }

        return response()->json($ultimaSenha);
    }

    /**
     * Chama a próxima senha disponível com base no prefixo e no status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chamarProximo(Request $request){
        $proximaSenha = $this->senha
            ->where('ativo',true)
            ->where('prefixo',$request['prefixo'])
            ->where('status',$this->constantesPainel::AGUARDANDO_CHAMADA)
            ->orderBy('id','desc')
            ->first();

        /*
         * Amarra a senha ao guiche a qual chamou
         */
        $proximaSenha->update([
            'guiche_id' => $request['guiche_id'],
            'status' => $this->constantesPainel::CHAMADA_RECEPCAO
        ]);

        return response()->json($proximaSenha);
    }

    private function verificarSenha($senha){
        if(is_null($senha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }
    }

    /*
     * Tabelas com campos para consultas
     */

    /**
     * Campos Tipos para consulta
     * @return array
     */
    public function tipos(){
        return [
            'id',
            'descricao',
            'prefixo'
        ];
    }

    /**
     * Campos grupoSala para consulta
     * @return array
     */
    public function grupoSala(){
        return [
            'descricao',
            'ativo'
        ];
    }

    /**
     * Campos telaGrupos para consulta
     * @return array
     */
    public function grupoSalaTelaGrupo(){
        return [
            'id',
            'sala_id',
            'tela_grupo_id',
            'ativo'
        ];
    }

    /**
     * Campos telas para consulta
     * @return array
     */
    public function grupoSalasTelaGrupoTelas(){
        return [
            'id',
            'descricao',
            'tela_grupo_id'
        ];
    }

    /**
     * Campos salas para consulta
     * @return array
     */
    public function grupoSalasSala(){
        return [
            'id',
            'descricao',
            'sala_id_stg',
            'ativo'
        ];
    }
}
