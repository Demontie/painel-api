<?php

namespace App\Http\Controllers\Api\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    private $paciente;

    public function __construct(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paciente = $this->paciente
            ->with([
                'grupo_tela'
            ])
            ->get();

        return response()->json($paciente);
    }

    public function pacientesDisponiveis()
    {
        $paciente = $this->paciente
            ->with([
                'grupo_tela'
            ])
            ->where('ativo',true)
            ->get();

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
        $novoPaciente = $this->paciente->create($request->all());

        return response()->json($novoPaciente,201);
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
