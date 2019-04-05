<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\GrupoTela;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrupoTelaController extends Controller
{
    private $grupoTela;

    public function __construct(GrupoTela $grupoTela)
    {
        $this->grupoTela = $grupoTela;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupoTela = $this->grupoTela->get();

        return response()->json($grupoTela);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoGrupoTela = $this->grupoTela->create($request->all());

        return response()->json($novoGrupoTela,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupoTela = $this->grupoTela->find($id);

        if(is_null($grupoTela)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        return response()->json($grupoTela);
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
        $grupoTela = $this->grupoTela->find($id);

        if(is_null($grupoTela)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        $grupoTela->update($request->all());

        return response()->json($grupoTela);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupoTela = $this->grupoTela->find($id);

        if(is_null($grupoTela)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        $grupoTela->update([
            'ativo' => false
        ]);

        return response()->json($grupoTela,204);
    }
}
