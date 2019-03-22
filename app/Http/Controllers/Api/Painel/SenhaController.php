<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\CamposConsultasPainel;
use App\Classes\Utils\ConstantesPainel;
use App\Models\Painel\Senha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenhaController extends Controller
{
    protected $senha;
    private $constantesPainel;
    private $camposConsultasPainel;

    public function __construct(Senha $senha,
                                ConstantesPainel $constantesPainel,
                                CamposConsultasPainel $camposConsultasPainel)
    {
        $this->senha = $senha;
        $this->constantesPainel = $constantesPainel;
        $this->camposConsultasPainel = $camposConsultasPainel;
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
                    $query->select($this->camposConsultasPainel->tipos());
                },
                'grupo_sala' => function($query){
                    $query->select($this->camposConsultasPainel->grupoSalaTelaGrupo());
                },
                'grupo_sala.tela_grupo' => function($query){
                    $query->select($this->camposConsultasPainel->grupoSala());
                },
                'grupo_sala.tela_grupo.telas' => function($query){
                    $query->select($this->camposConsultasPainel->grupoSalasTelaGrupoTelas());
                },
                'grupo_sala.sala' => function($query){
                    $query->select($this->camposConsultasPainel->grupoSalasSala());
                },
            ])
            //->whereDate('created_at',date('Y-m-d'))
            //->orderBy('id','desc')
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
        $senha = $this->senha->with([
            'tipo',
            'grupo_sala.tela_grupo.telas',
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
            return response()->json(['error' => 'Receita não encontrada'],404);
        }
        $senha->delete();
        return response()->json([],204);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function chamar(Request $request){
        $ultimaSenha = $this->senha
            ->where('ativo',true)
            ->with([
                'tipo',
                'grupo_sala.tela_grupo.telas',
                'grupo_sala.sala',
            ])
            ->orderBy('id', 'desc')
            ->first();

        return response()->json($ultimaSenha);
    }

    //public function
}
