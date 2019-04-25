<?php

namespace App\Http\Controllers\Api\Painel;

use App\Models\Painel\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    private $perfil;

    public function __construct(Perfil $perfil)
    {
        $this->perfil = $perfil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = $this->perfil
            ->with([
                'grupo_perfil'
            ])
            ->get();

        return response()->json($perfil);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoPerfil = $this->perfil->create($request->all());

        return response()->json($novoPerfil,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfil = $this->perfil
            ->with([
                'grupo_perfil'
            ])
            ->find($id);

        if(is_null($perfil)){
            return response()->json(['error' => 'Perfil não encontrado'],404);
        }

        return response()->json($perfil);
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
        $perfil = $this->perfil->find($id);

        if(is_null($perfil)){
            return response()->json(['error' => 'Perfil não encontrado'],404);
        }

        $perfil->update($request->all());

        return response()->json($perfil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = $this->perfil->find($id);

        if(is_null($perfil)){
            return response()->json(['error' => 'Perfil não encontrado'],404);
        }

        $perfil->update([
            'ativo' => false
        ]);

        return response()->json($perfil,204);
    }
}
