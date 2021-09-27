<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'text' => 'required|string',
            'tags' => 'required|string|max:800',
            'draft' => 'required|string',
            'image' => 'file|mimetypes:application/zip',
        ], [
            'required' => 'Preencha o campo :attribute',
            'string' => 'O campo :attribute precisa ser uma string',
            'max' => 'O campo :attribute precisa ser menor que :max',
            'file' => 'A :attribute precisa ser um arquivo',
            'mimetypes' => 'O arquivo precisa ser do tipo zip'
        ]);
        if ($validator->fails()) {
            ddh($validator->errors());
        }
        else{
            $article = new Article();

            $article->title = $request->title;
            $article->description = $request->description;
            $article->status = ($request->draft == "on") ? 2 : 1;

            $url = title_parser($request->title);
            $exists = DB::table('articles')->where('url', $url)->first();
            if ($exists) {
                $currentID = (DB::table('articles')->orderByDesc('id')->first() + 1);
                $url = title_parser($url, $currentID);
            }

            $tagsArr = tag_parser($request->tags);
            $article->tags = $tagsArr;

            article_text_to_html($request->text);
            

        }

    }
}
