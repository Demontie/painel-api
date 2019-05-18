<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Atendimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtendimentosController extends Controller
{
    private $atendimento;
    public function __construct(Atendimento $atendimento)
    {
        $this->atendimento = $atendimento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atendimento = $this->atendimento
            ->get();

        return response()->json($atendimento);
    }

    public function atendimentosDisponiveis()
    {
        $atendimento = $this->atendimento
            ->where('ativo',true)
            ->get();

        return response()->json($atendimento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $atendimento = $this->atendimento->where('cpf',$request->cpf)->first();

        if(is_null($atendimento)){
            $atendimento = $this->atendimento->create($request->all());
        }

        return response()->json($atendimento,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atendimento = $this->atendimento
            ->with([
                'grupo_tela'
            ])
            ->find($id);

        if(is_null($atendimento)){
            return response()->json(['error' => 'Atendimento não encontrado'],404);
        }

        return response()->json($atendimento);
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
        $atendimento = $this->atendimento->find($id);

        if(is_null($atendimento)){
            return response()->json(['error' => 'Atendimento não encontrado'],404);
        }

        $atendimento->update($request->all());

        return response()->json($atendimento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atendimento = $this->atendimento->find($id);

        if(is_null($atendimento)){
            return response()->json(['error' => 'Atendimento não encontrado'],404);
        }

        $atendimento->update([
            'ativo' => false
        ]);

        return response()->json($atendimento,204);
    }
}
