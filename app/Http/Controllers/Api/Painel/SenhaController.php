<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\ConstantesPainel;
use App\Events\SenhaChamada;
use App\Events\SenhaGerada;
use App\Models\Painel\Senha;
use function foo\func;
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
        $senhas = $this->senha
            ->select([
                "$this->tableName.*",
                'tipo_senhas.prefixo',
                'tipo_senhas.descricao',
                'tipo_senhas.prioridade',
                'tipo_senhas.cor'
            ])
            ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
            ->where("$this->tableName.ativo",true)
            ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
            ->whereDay("$this->tableName.created_at",date('d'))
            ->whereMonth("$this->tableName.created_at", date('m'))
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

        $senhaInserida = $this->senha
            ->with([
                'tipo_senha',
            ])->find($senha->id);

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
     * Chama a próxima senha disponível com base na prioridade e no status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chamarProximo(Request $request){

        /*
         * Verifica ultima senha chamada
         */
        $ultimaSenhaChamada = $this->senha
            ->select([
                "$this->tableName.*",
                'tipo_senhas.prefixo',
                'tipo_senhas.descricao',
                'tipo_senhas.prioridade'
            ])
            ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
            ->where("$this->tableName.ativo",true)
            ->where("$this->tableName.status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->orderBy('updated_at','desc')
            ->take(5)
            ->first();

        /*
         * Analisa de a ultima senha é ou não prioridade, caso seja a próxima senha não será prioridade e virse e versa
         */
        if(isset($ultimaSenhaChamada->prioridade) && !$ultimaSenhaChamada->prioridade){
            $proximaSenha = $this->senha
                ->select([
                    "$this->tableName.*",
                    'tipo_senhas.prefixo',
                    'tipo_senhas.descricao'
                ])
                ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
                ->where('tipo_senhas.prioridade',true)
                ->where("$this->tableName.ativo",true)
                ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->orderBy("$this->tableName.id")
                ->first();;
            /*
             * Caso não existam mais senhas prioridades a proxima senha sera sem prioridade
             */
            if(is_null($proximaSenha)){
                $proximaSenha = $this->senha
                    ->select([
                        "$this->tableName.*",
                        'tipo_senhas.prefixo',
                        'tipo_senhas.descricao',
                        'tipo_senhas.prioridade'
                    ])
                    ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
                    ->where('tipo_senhas.prioridade',false)
                    ->where("$this->tableName.ativo",true)
                    ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                    ->orderBy("$this->tableName.id")
                    ->first();
            }
        }
        else{
            $proximaSenha = $this->senha
                ->select([
                    "$this->tableName.*",
                    'tipo_senhas.prefixo',
                    'tipo_senhas.descricao',
                    'tipo_senhas.prioridade'
                ])
                ->join('tipo_senhas',"$this->tableName.tipo_senha_id",'=','tipo_senhas.id')
                ->where('tipo_senhas.prioridade',false)
                ->where("$this->tableName.ativo",true)
                ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->orderBy("$this->tableName.id")
                ->first();
        }

        if(is_null($proximaSenha)){
            return response()->json('Todas as senhas forma chamadas');
        }

        /*
         * Amarra a senha ao guiche a qual chamou
         */
        $proximaSenha->update([
            'guiche_id' => $request->guiche_id,
            'status' => $this->constantesPainel::CHAMADA_RECEPCAO,
            'quantidade_chamada' => 1
        ]);

        broadcast(new SenhaChamada($proximaSenha));

        return response()->json($proximaSenha);
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
        //dd($request->guiche_id);

        $ultimaSenha = $this->senha
            ->where('ativo',true)
            ->where('guiche_id',$request->guiche_id)
            ->where('status',$this->constantesPainel::CHAMADA_RECEPCAO)
            ->with([
                'tipo_senha',
                'grupo_sala.grupo_tela.telas',
                'grupo_sala.sala',
            ])
            ->orderBy('updated_at','desc')
            ->first();

        $ultimaSenha->update([
            'quantidade_chamada' => ($ultimaSenha->quantidade_chamada + 1)
        ]);

        if(is_null($ultimaSenha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }

        broadcast(new SenhaChamada($ultimaSenha));

        return response()->json($ultimaSenha);
    }
}
