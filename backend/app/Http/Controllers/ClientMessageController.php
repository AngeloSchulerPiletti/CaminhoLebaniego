<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ClientMessageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:35',
            'email' => 'required|string|max:80|email',
            'message' => 'required|string|max:1000',
        ], [
            'required' => 'Preencha o campo :attribute',
            'string' => 'O campo :attribute precisa ser uma string',
            'max' => 'O campo :attribute precisa ser menor que :max',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        try {
            Mail::raw($request->message, function ($message) {
                $message->to('angelopiletti@gmail.com', 'Angelo S. Piletti')->subject('Mensagem de Usuário do Site');
                $message->from('angelopiletti@gmail.com', "Angelo De novo");
            });

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
