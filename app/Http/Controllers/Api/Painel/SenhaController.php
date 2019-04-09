<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\ConstantesPainel;
use App\Events\SenhaGerada;
use App\Models\Painel\Senha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenhaController extends Controller
{
    protected $senha;
    private $constantesPainel;
    private $tableName;

    public function __construct(Senha $senha,
                                ConstantesPainel $constantesPainel)
    {
        $this->senha = $senha;
        $this->constantesPainel = $constantesPainel;
        $this->tableName = $this->senha->getTable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $senhas = $this->senha
//            ->where('status',$this->constantesPainel::AGUARDANDO_CHAMADA)
//            ->where('ativo',true)
//            ->with([
//                'tipo_senha',
//                'grupo_sala',
//                'grupo_sala.grupo_tela',
//                'grupo_sala.grupo_tela.telas',
//                'grupo_sala.sala',
//            ])
//            ->whereDay('created_at',date('d'))
//            ->whereMonth('created_at', date('m'))
//            //->whereDate('created_at',date('Y-m-d'))
//            ->orderBy('id')
//            //->take(5)
//            ->get();

        $senhas = $this->senha
            ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
            ->where('tipo_senhas.prioridade',false)
            ->where("$this->tableName.ativo",true)
            //->where('prefixo',$request['prefixo'])
            ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
            ->orderBy("$this->tableName.id")
            ->get();

        return response()->json($senhas);
    }

    public function getSenhasPorPeriodo(Request $request){
        if(!$request->dataFiltro){
            $dataFiltro = date('Y-m-d 00:00:00');
        }else{
            $dataFiltro = $request->dataFiltro;
        }
        //dd($dataFiltro);
        $senhas = $this->senha
            ->where('ativo',true)
            ->with([
                'tipo_senha',
                'grupo_sala',
                'grupo_sala.grupo_tela',
                'grupo_sala.grupo_tela.telas',
                'grupo_sala.sala',
            ])
            //->whereDate('created_a', '>=', "$dataFiltro + INTERVAL 1 DAY")
            ->orderBy('id','desc')
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
            ->where('tipo_senha_id',$request['tipo_senha_id'])
            ->orderBy('id','desc')->first();

        $numero = is_null($ultimaSenha) || ($ultimaSenha->numero == $this->constantesPainel::LIMITE_SENHAS) ? 1 : $ultimaSenha->numero + 1;

        $request['numero'] = $numero;

        $senha = $this->senha->create($request->all());

        /*
         * Consulta para retornar senha com dados auxiliares para a view
         */
        $senhaInserida = $this->senha
            ->with([
                'tipo_senha',
            ])->find($senha->id);

        $senhaInserida->numero = str_pad($numero,3,'0',STR_PAD_LEFT);

        broadcast(new SenhaGerada($senhaInserida));

        return response()->json($senhaInserida,201);
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
                'tipoSenha',
                'grupo_sala',
                'grupo_sala.grupo_tela',
                'grupo_sala.grupo_tela.telas',
                'grupo_sala.sala',
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
                'tipo_senha',
                'grupo_sala.grupo_tela.telas',
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

        $ultimaChamada = $this->senha
            ->where('ativo',true)
            //->where('prefixo',$request['prefixo'])
            ->where('status',$this->constantesPainel::CHAMADA_RECEPCAO)
            ->with([
                'tipo_senha',
                'grupo_sala.grupo_tela.telas'
            ])
            ->orderBy('id')
            ->first();

        if($ultimaChamada->tipo_senha->prioridade){
            $proximaSenha = $this->senha
                ->join('tipo_senhas','senhas.tipo_senha_id','=','tipo_senhas.id')
                ->where('tipo_senhas.prioridade',false)
                ->where('ativo',true)
                //->where('prefixo',$request['prefixo'])
                ->where('status',$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->orderBy('id')
                ->get();
        }else{
            $proximaSenha = $this->senha
                ->where('ativo',true)
                //->where('prefixo',$request['prefixo'])
                ->where('status',$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->with([
                    'tipo_senha',
                    'grupo_sala.grupo_tela.telas'
                ])
                ->orderBy('id')
                ->take(2)
                ->get();
        }


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
            'prefixo',
            'grupo_tela_id'
        ];
    }

    /**
     * Campos grupoSala para consulta
     * @return array
     */
    public function grupoSala(){
        return [
            'id',
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
            'grupo_tela_id',
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
            'grupo_tela_id'
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

    public function tipoGrupoTelas(){

    }
}
