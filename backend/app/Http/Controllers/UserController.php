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
            'string' => 'Insira um :attribute válido'
        ], [
            'email' => 'E-mail',
            'password' => 'Senha',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => array_values($validator->errors()->all())]);
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['error' => ['Você não tem acesso a está área']]);
        } else if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => ['Dados inválidos']]);
        }

        return response()->json(['user' => $user, 'token' => $user->createToken('API_token')->plainTextToken], 201);
    }

    public function logout(Request $request)
    {
        $totalTokens = auth()->user()->tokens()->delete();
        return response()->json([messages => ["Você foi deslogado e " . $totalTokens . " tokens foram apagados"]]);
    }
}
