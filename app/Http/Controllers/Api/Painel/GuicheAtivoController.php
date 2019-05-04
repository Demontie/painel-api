<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\GuicheAtivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuicheAtivoController extends Controller
{
    private $guicheAtivo;

    public function __construct(GuicheAtivo $guicheAtivo)
    {
        $this->guicheAtivo = $guicheAtivo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guicheAtivo = $this->guicheAtivo
            ->get();

        return response()->json($guicheAtivo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoGuicheAtivo = $this->guicheAtivo->create($request->all());

        return response()->json($novoGuicheAtivo,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guicheAtivo = $this->guicheAtivo
            ->find($id);

        if(is_null($guicheAtivo)){
            return response()->json(['error' => 'Guiche ativo não encontrado'],404);
        }

        return response()->json($guicheAtivo);
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
        $guicheAtivo = $this->guicheAtivo->find($id);

        if(is_null($guicheAtivo)){
            return response()->json(['error' => 'Guiche ativo não encontrado'],404);
        }

        $guicheAtivo->update($request->all());

        return response()->json($guicheAtivo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guicheAtivo = $this->guicheAtivo->find($id);

        if(is_null($guicheAtivo)){
            return response()->json(['error' => 'Guiche ativo não encontrado'],404);
        }

        $guicheAtivo->update([
            'ativo' => false
        ]);

        return response()->json($guicheAtivo,204);
    }
}
