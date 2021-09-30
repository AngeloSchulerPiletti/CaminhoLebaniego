<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleListController extends Controller
{
    static function getArticles($keyword, $page = 1, $perpage = 10, $status = 1)
    {
        // return response()->json([$keyword], 400);
        if ($keyword == "todos") {
            $articles_selection = DB::table('articles')->where('status', $status)->orderByDesc('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
            $articles_selection = chared_string_to_array($articles_selection, 'tags', ',', true);
        
        } else {
            $articles_selection = DB::table('articles')->where('status', $status)->orderBy('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
            $keyword = tag_parser(tag_converter($keyword));

            foreach ($articles_selection as $key => $article) {
                $article_tags = $article->tags;
                $article = chared_string_to_array($article, 'tags', ',');
                $article_tags = tag_converter($article_tags);
                $article_tags = tag_parser($article_tags);

                if (count(array_intersect($article_tags, $keyword)) < 1) {
                    $articles_selection->forget($key);
                }
            }
        }

        if (count($articles_selection) < 1) {
            return response()->json(['error' => ['Nenhum artigo foi encontrado']], 404);
        }
        return $articles_selection;
    }
}
