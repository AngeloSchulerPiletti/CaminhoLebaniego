<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request){
        if ($request->file('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            ddh($request);
            return response()->json([$name=> $extension, "isso?" => $request->text]);
        }else{
            ddh($request);
            return response()->json(['failed']);
        }
    }
}
