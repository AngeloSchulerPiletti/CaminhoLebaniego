<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArticleListController extends Controller
{
    static function getArticles(Request $request, $keyword, $page = 1, $perpage = 10, $status = 1)
    {
        if ($status != 1 && !auth('sanctum')->user()) {
            return response()->json(['error' => ['Você não tem permissão para ver esses artigos']], 403);
        }
        if ($keyword == "todos") {
            $articles_selection = DB::table('articles')->where('status', $status)->orderByDesc('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
            $total_articles = DB::table('articles')->where('status', $status)->get()->count();
            $articles_selection = chared_string_to_array($articles_selection, 'tags', ',', true);

        } else {
            $articles_selection = DB::table('articles')->where('status', $status)->orderBy('updated_at')->skip($perpage * ($page - 1))->take($perpage)->get();
            $total_articles = DB::table('articles')->where('status', $status)->get()->count();
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
            return response()->json(['error' => ['Nenhum artigo foi encontrado']]);
        }
        return response()->json(['articlesList' => $articles_selection, 'totalArticles' => $total_articles]);
    }
}
