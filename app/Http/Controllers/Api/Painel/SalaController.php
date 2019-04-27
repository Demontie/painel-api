<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaController extends Controller
{
    private $sala;

    public function __construct(Sala $sala)
    {
        $this->sala = $sala;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sala = $this->sala
            ->with([
                'grupo_tela'
            ])
            ->where('ativo',true)
            ->get();

        return response()->json($sala);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salaInativa = $this->sala
            ->where('descricao', $request->descricao)
            ->where('grupo_tela_id', $request->grupo_tela_id)
            ->first();

        $novaSala = $this->sala->create($request->all());

        return response()->json($novaSala,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sala = $this->sala
            ->find($id);

        if(is_null($sala)){
            return response()->json(['error' => ' de salas não encontrado'],404);
        }

        return response()->json($sala);
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
        $sala = $this->sala->find($id);

        if(is_null($sala)){
            return response()->json(['error' => ' de salas não encontrado'],404);
        }

        $sala->update($request->all());

        return response()->json($sala);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sala = $this->sala->find($id);

        if(is_null($sala)){
            return response()->json(['error' => ' de salas não encontrado'],404);
        }

        $sala->update([
            'ativo' => false
        ]);

        return response()->json($sala,204);
    }
}
