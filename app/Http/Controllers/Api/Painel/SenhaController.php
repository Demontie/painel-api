<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\Status_Senha;
use App\Models\Painel\Senha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenhaController extends Controller
{
    protected $senha;
    private $statusSenha;

    public function __construct(Senha $senha, Status_Senha $statusSenha)
    {
        $this->senha = $senha;
        $this->statusSenha = $statusSenha;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senhas = $this->senha
            //->where('id',1)
            ->where('status',$this->statusSenha::AGUARDANDO_CHAMADA())
            ->where('ativo',true)
            ->with([
                'tipo',
                'grupo_sala.tela_grupo.telas',
                'grupo_sala.sala',
            ])
            //->whereDate('created_at',date('Y-m-d'))
            //->orderBy('id','desc')
            ->take(5)
            ->get();

        return response()->json($senhas);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $senha = $this->senha
            ->with([
                'tipo',
                'grupo_sala.tela_grupo.telas',
                'grupo_sala.sala',
            ])
            ->create($request->all());

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
        $senha = $this->senha->with([
            'tipo',
            'grupo_sala.tela_grupo.telas',
            'grupo_sala.sala',
        ])->find($id);
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
        $senha = $this->senha->with([
            'tipo',
            'grupo_sala.tela_grupo.telas',
            'grupo_sala.sala',
        ])->find($id);
        if(is_null($senha)){
            return response()->json(['error' => 'Receita não encontrada'],404);
        }
        $senha->delete();
        return response()->json([],204);
    }
}
