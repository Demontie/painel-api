<?php

namespace App\Http\Controllers\Api\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user
            ->where('ativo',true)
            ->get();

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newUser = $request->only([
            'name',
            'email',
            'password'
        ]);
        $newUser['password'] = bcrypt($newUser['password']);

        $this->user->create($newUser);

        return response()->json($newUser,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user
            ->find($id);

        if(is_null($user)){
            return response()->json(['error' => 'Usuário não encontrado'],404);
        }

        return response()->json($user);
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
        $user = $this->user->find($id);

        if(is_null($user)){
            return response()->json(['error' => 'Usuário não encontrado'],404);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if(is_null($user)){
            return response()->json(['error' => 'Usuário não encontrado'],404);
        }

        $user->update([
            'ativo' => false
        ]);

        return response()->json($user,204);
    }
}
