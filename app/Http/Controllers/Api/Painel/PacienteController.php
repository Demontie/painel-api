<?php

namespace App\Http\Controllers\Api\Painel;

use App\Classes\Utils\ConstantesPainel;
use App\Models\Painel\Atendimento;
use App\Models\Painel\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    private $paciente;
    private $atendimento;
    private $constantesPainel;

    public function __construct(Paciente $paciente, ConstantesPainel $constantesPainel, Atendimento $atendimento)
    {
        $this->paciente = $paciente;
        $this->atendimento = $atendimento;
        $this->constantesPainel = $constantesPainel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paciente = $this->paciente
//            ->with([
//                'atendimentos.senha'
//            ])
            ->get();

        return response()->json($paciente);
    }

    public function pacientePorSenha(Request $request){
        $paciente = $this->paciente
            ->with([
                'atendimentos',
                'atendimentos.senha'
            ])
            ->whereHas('atendimentos', function ($query) use ($request){
                $query->where('senha_id', $request->senha_id);
            })
            ->get();

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        return response()->json($paciente);
    }

    public function pacientePorMedico(Request $request){
        $paciente = $this->paciente
            ->with([
                'atendimentos',
                'atendimentos.senha',
            ])
            ->whereHas('atendimentos', function ($query) use ($request){
                $query
                    ->where('medico_id', $request->medico_id);
            })
            ->whereDay("created_at",date('d'))
            ->whereMonth("created_at", date('m'))
            ->get();

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        return response()->json($paciente);
    }

    public function proximoPaciente(Request $request){
        $paciente = $this->paciente
            ->with([
                'atendimentos',
                //'atendimentos.senha'
            ])
            ->whereHas('atendimentos', function ($query) use ($request){
                $query
                    ->where('senha_id', 1);
            })
            ->get();

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        return response()->json($paciente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = $this->paciente->where('cpf',$request->cpf)->first();

        if(is_null($paciente)){
            $paciente = $this->paciente->create($request->all());
        }

        return response()->json($paciente,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = $this->paciente
            ->with([
                'grupo_tela'
            ])
            ->find($id);

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        return response()->json($paciente);
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
        $paciente = $this->paciente->find($id);

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        $paciente->update($request->all());

        return response()->json($paciente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = $this->paciente->find($id);

        if(is_null($paciente)){
            return response()->json(['error' => 'Paciente não encontrado'],404);
        }

        $paciente->update([
            'ativo' => false
        ]);

        return response()->json($paciente,204);
    }
}
