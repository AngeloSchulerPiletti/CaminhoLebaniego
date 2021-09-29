<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleListController extends Controller
{
    static function getArticles($page = 1, $perpage = 10)
    {
        $articles_selection = DB::table('articles')->where('status', 1)->orderByDesc('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
        $articles_selection = chared_string_to_array($articles_selection, 'tags', ',', true);

        return $articles_selection;
    }

    static function getArticlesByQuery($query, $page = 1, $perpage = 10)
    {
        if (!$query) {
            return response()->json(['error' => 'Você precisa fazer uma busca válida']);
        }
        $articles_selection = DB::table('articles')->where('status', 1)->orderBy('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
        $query = tag_parser(tag_converter($query));

        foreach ($articles_selection as $key => $article) {
            $article->tags = tag_converter($article->tags);
            $article->tags = tag_parser($article->tags);


            if (count(array_intersect($article->tags, $query)) < 1) {
                $articles_selection->forget($key);
            }
        }
        return $articles_selection;
    }
}
