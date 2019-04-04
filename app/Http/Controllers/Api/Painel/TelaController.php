<?php

namespace App\Http\Controllers;

use App\Models\Painel\Tela;
use Illuminate\Http\Request;

class TelaController extends Controller
{
    private $tela;

    public function __construct(Tela $tela)
    {
        $this->tela = $tela;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tela = $this->tela->get();

        return response()->json($tela);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoTela = $this->tela->create($request->all());

        return response()->json($novoTela,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tela = $this->tela->find($id);

        if(is_null($tela)){
            return response()->json(['error' => ' de telas não encontrado'],404);
        }

        return response()->json($tela);
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
        $tela = $this->tela->find($id);

        if(is_null($tela)){
            return response()->json(['error' => ' de telas não encontrado'],404);
        }

        $tela->update($request->all());

        return response()->json($tela);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tela = $this->tela->find($id);

        if(is_null($tela)){
            return response()->json(['error' => ' de telas não encontrado'],404);
        }

        $tela->update([
            'ativo' => false
        ]);

        return response()->json($tela,204);
    }
}
