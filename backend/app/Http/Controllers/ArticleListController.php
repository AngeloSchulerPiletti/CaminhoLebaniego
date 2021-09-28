<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleListController extends Controller
{
    static function getArticles($page = 1, $perpage = 10)
    {
        if (!auth()->user()) {
            $articles_selection = DB::table('articles')->where('status', 1)->orderByDesc('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
        } else {
            $articles_selection = DB::table('articles')->orderByDesc('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
        }
        
        return $articles_selection;
    }
}
