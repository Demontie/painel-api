<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Guiche;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuicheController extends Controller
{
    private $guiche;

    public function __construct(Guiche $guiche)
    {
        $this->guiche = $guiche;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guiche = $this->guiche
            ->with([
                'grupo_tela'
            ])
            ->get();

        return response()->json($guiche);
    }

    public function guichesDisponiveis()
    {
        $guiche = $this->guiche
            ->with([
                'grupo_tela'
            ])
            ->where('ativo',true)
            ->get();

        return response()->json($guiche);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoGuiche = $this->guiche->create($request->all());

        return response()->json($novoGuiche,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guiche = $this->guiche
            ->with([
                'grupo_tela'
            ])
            ->find($id);

        if(is_null($guiche)){
            return response()->json(['error' => 'Guiche não encontrado'],404);
        }

        return response()->json($guiche);
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
        $guiche = $this->guiche->find($id);

        if(is_null($guiche)){
            return response()->json(['error' => 'Guiche não encontrado'],404);
        }

        $guiche->update($request->all());

        return response()->json($guiche);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guiche = $this->guiche->find($id);

        if(is_null($guiche)){
            return response()->json(['error' => 'Guiche não encontrado'],404);
        }

        $guiche->update([
            'ativo' => false
        ]);

        return response()->json($guiche,204);
    }

    public function guicheStart(){
        $this->guiche->create([
            'descricao' => 'Guiche 2',
            'grupo_tela_id' => 2
        ]);
    }
}
