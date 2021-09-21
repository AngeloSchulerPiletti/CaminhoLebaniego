<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'required' => ':attribute é obrigatório',
            'string' => 'insira algo válido'
        ], [
            'email' => 'E-mail',
            'password' => 'Senha',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['error' => ['Você não tem acesso a está área']], 401);
        } else if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => ['Dados inválidos']], 401);
        }

        return response()->json(['user'=> $user, 'token' => $user->createToken('API_token')->plainTextToken]);
    }

    public function logout(Request $request){
        $totalTokens = auth()->user()->tokens()->delete(); 

        return response()->json(['message' => "Você foi deslogado e ".$totalTokens." foram apagados"]);
    }
}
