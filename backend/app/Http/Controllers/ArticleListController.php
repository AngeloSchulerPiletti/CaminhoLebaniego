<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleListController extends Controller
{
    static function getArticles($page = 1, $perpage = 10){
        $articles_selection = DB::table('articles')->orderByDesc('id')->skip($perpage*($page - 1))->take($perpage)->get();

        return $articles_selection;
    }
}
