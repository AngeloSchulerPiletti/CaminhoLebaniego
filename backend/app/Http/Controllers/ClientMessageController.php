<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ClientMessageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:100',
                'phone' => 'required|string|max:35',
                'email' => 'required|string|max:80|email',
                'message' => 'required|string|max:1000',
            ],
            [
                'required' => 'Preencha o campo de :attribute',
                'string' => 'O campo de :attribute precisa ser uma string',
                'max' => 'O campo de :attribute precisa ser menor que :max',
            ],
            [
                'name' => 'nome',
                'phone' => 'telefone',
                'email' => 'email',
                'message' => 'mensagem',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => array_values($validator->errors()->all())]);
        }


        try {
            Mail::raw($request->message, function ($message) {
                $message->to('contato@caminholebaniego.com.br', 'Jone Mario Piletti')->subject('Mensagem do Site');
                $message->from('site@caminholebaniego.com.br', "Contato do Site");
            });

            try {
                Mail::raw($request->message, function ($message) {
                    $message->to('piletti@bol.com.br', 'Jone Mario Piletti')->subject('Mensagem do Site');
                    $message->from('site@caminholebaniego.com.br', "Contato do Site");
                });
            } catch (\Exception $e) {
                return response()->json(['messages'=> ['Mensagem enviada apenas ao email do site'], 'error' => [$e->getMessage()]]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => [$e->getMessage()]]);
        }

        return response()->json(['messages' => ['Sua mensagem foi enviada com sucesso!']]);
    }
}
