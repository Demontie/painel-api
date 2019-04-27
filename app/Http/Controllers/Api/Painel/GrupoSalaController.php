<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Grupo_sala;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrupoSalaController extends Controller
{
    private $grupoSala;

    public function __construct(Grupo_sala $grupoSala)
    {
        $this->grupoSala = $grupoSala;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupoSala = $this->grupoSala
            ->with([
                'grupo_tela',
                'salas'
            ])
            ->whereHas(
                'grupo_tela', function ($query){
                    $query->distinct('id');
            })
            ->get();

        return response()->json($grupoSala);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoGrupoSala = $this->grupoSala->create($request->all());

        return response()->json($novoGrupoSala,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupoSala = $this->grupoSala
            ->with([
                'grupo_tela',
                'sala'
            ])
            ->find($id);

        if(is_null($grupoSala)){
            return response()->json(['error' => 'Grupo de salas não encontrado'],404);
        }

        return response()->json($grupoSala);
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
        $grupoSala = $this->grupoSala->find($id);

        if(is_null($grupoSala)){
            return response()->json(['error' => 'Grupo de salas não encontrado'],404);
        }

        $grupoSala->update($request->all());

        return response()->json($grupoSala);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupoSala = $this->grupoSala->find($id);

        if(is_null($grupoSala)){
            return response()->json(['error' => 'Grupo de salas não encontrado'],404);
        }

        $grupoSala->update([
            'ativo' => false
        ]);

        return response()->json($grupoSala,204);
    }
}
