<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\ConstantesPainel;
use App\Events\SenhaChamada;
use App\Events\SenhaGerada;
use App\Models\Painel\Atendimento;
use App\Models\Painel\Senha;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenhaController extends Controller
{
    protected $senha;
    private $constantesPainel;
    private $tableName;
    private $atendimento;

    public function __construct(Senha $senha,
                                ConstantesPainel $constantesPainel,
                                Atendimento $atendimento)
    {
        $this->senha = $senha;
        $this->constantesPainel = $constantesPainel;
        $this->atendimento = $atendimento;
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
            ->whereDay("$this->tableName.created_at",date('d'))
            ->whereMonth("$this->tableName.created_at", date('m'))
            ->where("$this->tableName.ativo",true)
            ->where("$this->tableName.status",$this->constantesPainel::AGUARDANDO_CHAMADA)
            ->orWhere("$this->tableName.status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->whereDay("$this->tableName.created_at",date('d'))
            ->whereMonth("$this->tableName.created_at", date('m'))
            ->orderBy("$this->tableName.id")
            ->get();

        return response()->json($senhas);
    }

    public function getSenhasChamadas(){
        $senhasChamadas = $this->senha
            ->with([
                'tipo_senha',
                'grupo_sala',
                'grupo_sala.grupo_tela',
                'grupo_sala.grupo_tela.telas',
                'grupo_sala.sala',
                'guiche'
            ])
            ->whereDay("$this->tableName.created_at",date('d'))
            ->whereMonth("$this->tableName.created_at",date('m'))
            ->where("$this->tableName.status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->orWhere("$this->tableName.status",$this->constantesPainel::ATENDIDA)
            ->whereDay("$this->tableName.created_at",date('d'))
            ->whereMonth("$this->tableName.created_at",date('m'))
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();

        return response()->json($senhasChamadas);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        $senhaAguardandoAtendimento = $this->senha
            ->where('guiche_id',$request->guiche_id)
            ->where("status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->first();

        if(!is_null($senhaAguardandoAtendimento)){
            return response()->json(['error' => 'Existe uma senha esperando atendimento.'],403);
        }

        /*
         * Verifica ultima senha chamada
         */
        $ultimaSenhaChamada = $this->senha
            ->with([
                'tipo_senha',
            ])
            ->where("ativo",true)
            ->where("status",$this->constantesPainel::ATENDIDA)
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->orderBy('updated_at','desc')
            ->take(5)
            ->first();

        //dd($ultimaSenhaChamada);

        /*
         * Analisa de a ultima senha é ou não prioridade, caso seja a próxima senha não será prioridade e virse e versa
         */
        if(!is_null($ultimaSenhaChamada) && !$ultimaSenhaChamada->tipo_senha->prioridade){
            $proximaSenha = $this->senha
                ->with([
                    'tipo_senha',
                    'guiche',
                    'grupo_sala.grupo_tela.telas',
                    'grupo_sala.sala',
                ])
                ->whereHas('tipo_senha', function ($query){
                    $query->select([
                        'prefixo',
                        'descricao',
                        'prioridade'
                    ])
                        ->where('prioridade',true);
                })
                ->where("ativo",true)
                ->where("status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->whereDay("created_at",date('d'))
                ->whereMonth("created_at", date('m'))
                ->orderBy("id")
                ->first();
            /*
             * Caso não existam mais senhas prioridades a proxima senha sera sem prioridade
             */
            if(is_null($proximaSenha)){
                $proximaSenha = $this->senha
                    ->with([
                        'tipo_senha',
                        'guiche',
                        'grupo_sala.grupo_tela.telas',
                        'grupo_sala.sala',
                    ])
                    ->whereHas('tipo_senha', function ($query){
                        $query->select([
                            'prefixo',
                            'descricao',
                            'prioridade'
                        ])
                            ->where('prioridade',false);
                    })
                    ->where("ativo",true)
                    ->where("status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                    ->whereDay("created_at",date('d'))
                    ->whereMonth("created_at", date('m'))
                    ->orderBy("id")
                    ->first();
            }
        }
        else{
            $proximaSenha = $this->senha
                ->with([
                    'tipo_senha',
                    'guiche',
                    'grupo_sala.grupo_tela.telas',
                    'grupo_sala.sala',
                ])
                ->whereHas('tipo_senha', function ($query){
                    $query->select([
                        'prefixo',
                        'descricao',
                        'prioridade'
                    ])
                        ->where('prioridade',false);
                })
                ->where("ativo",true)
                ->where("status",$this->constantesPainel::AGUARDANDO_CHAMADA)
                ->whereDay("created_at",date('d'))
                ->whereMonth("created_at", date('m'))
                ->orderBy("id")
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

    public function atenderSenha(Request $request){
//        try{
//
//        }catch (\Exception $e){
//            return response()->json(['error'=>'Houve um erro no atendimento da senha'],500);
//        }
        $senha = $this->senha
            ->with([
                'tipo_senha',
            ])
            ->where('guiche_id',$request->guiche_id)
            ->where("status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->first();

        if(is_null($senha)){
            return response()->json(['error' => 'Senha não encontrada'],404);
        }

        //dd($request->medico_id);

        $this->atendimento->create([
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id,
            'senha_id' => $senha->id,
            'sala_id' => $request->sala_id
        ]);

        $senha->update([
            'status' => $this->constantesPainel::ATENDIDA,
        ]);

        return response()->json($senha);
    }

    public function ultimaSenhaChamada(Request $request){
        $senha = $this->senha
            ->with([
                'tipo_senha',
            ])
            ->where('guiche_id',$request->guiche_id)
            ->where("status",$this->constantesPainel::CHAMADA_RECEPCAO)
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->first();

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
        //dd($request->guiche_id);

        $ultimaSenha = $this->senha
            ->where('ativo',true)
            ->where('guiche_id',$request->guiche_id)
            ->where('status',$this->constantesPainel::CHAMADA_RECEPCAO)
            ->with([
                'tipo_senha',
                'grupo_sala.grupo_tela.telas',
                'grupo_sala.sala',
                'guiche'
            ])
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->orderBy('updated_at','desc')
            ->first();

        if(is_null($ultimaSenha)){
            return response()->json('Todas as senhas forma chamadas');
        }

        $ultimaSenha->update([
            'quantidade_chamada' => ($ultimaSenha->quantidade_chamada + 1)
        ]);

        broadcast(new SenhaChamada($ultimaSenha));

        return response()->json($ultimaSenha);
    }
}
