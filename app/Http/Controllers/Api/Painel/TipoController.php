<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoController extends Controller
{
    protected $tipo;

    public function __construct(Tipo $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipos = $this->tipo->get();

        return response()->json($tipos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoTipoSenha = $this->tipo->create($request->all());

        return response()->json($novoTipoSenha,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = $this->tipo->find($id);

        if(is_null($tipo)){
            return response()->json(['error' => 'Tipo de senha não encontrado'],404);
        }

        return response()->json($tipo);
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
        $tipo = $this->tipo->find($id);

        if(is_null($tipo)){
            return response()->json(['error' => 'Tipo de senha não encontrado'],404);
        }

        $tipo->update($request->all());

        return response()->json($tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = $this->tipo->find($id);

        if(is_null($tipo)){
            return response()->json(['error' => 'Tipo de senha não encontrado'],404);
        }

        $tipo->delete();

        return response()->json($tipo,204);
    }
}
