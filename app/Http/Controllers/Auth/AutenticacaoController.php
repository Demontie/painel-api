<?php

namespace App\Http\Controllers\Auth;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutenticacaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')
    }


    public function autenticar()
    {
        // grab credentials from the request
        $credentials = request()->only('email', 'password');
//        $credentials = [
//          'email' => request()->email,
//          'password' => request()->senha
//        ];
//
        //dd($credentials);


        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }

        $user = auth()->user();

        // all good so return the token
        return response()->json(compact('token','user'));
    }

    public function getUsuarioAutenticado(Request $request)
    {
        /*
         * Caso a requisição não tenha token
         */
        $token = $request->header('authorization');
        if(is_null($token) || empty($token)){
            return response()->json(['token_invalid'], 401);
        }

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function cadastrarUsuario(Request $request, User $user){

        $newUser = $request->only([
            'name',
            'email',
            'password'
        ]);
        $newUser['password'] = bcrypt($newUser['password']);

        $user->create($newUser);

        return $this->autenticar();
    }
}
