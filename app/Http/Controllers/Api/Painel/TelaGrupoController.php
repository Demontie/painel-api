<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Tela_grupo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TelaGrupoController extends Controller
{
    private $telaGrupo;

    public function __construct(Tela_grupo $telaGrupo)
    {
        $this->telaGrupo = $telaGrupo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $telaGrupo = $this->telaGrupo->get();

        return response()->json($telaGrupo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoGrupoTela = $this->telaGrupo->create($request->all());

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
        $telaGrupo = $this->telaGrupo->find($id);

        if(is_null($telaGrupo)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        return response()->json($telaGrupo);
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
        $telaGrupo = $this->telaGrupo->find($id);

        if(is_null($telaGrupo)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        $telaGrupo->update($request->all());

        return response()->json($telaGrupo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $telaGrupo = $this->telaGrupo->find($id);

        if(is_null($telaGrupo)){
            return response()->json(['error' => 'Grupo de telas não encontrado'],404);
        }

        $telaGrupo->update([
            'ativo' => false
        ]);

        return response()->json($telaGrupo,204);
    }
}
