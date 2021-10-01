<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class ArticleController extends Controller
{
    public function index($url){
        if (!auth('sanctum')->user()) { // PRECISA SER CORRIGIDO
            $article = DB::table('articles')->where('url', $url)->where('status', 1)->first();
        }
        else{
            $article = DB::table('articles')->where('url', $url)->first();
        }
        if ($article) {
            $article = chared_string_to_array($article, 'images_names', ',');
            $article = chared_string_to_array($article, 'tags', ',');
            return $article;
        }
        return response()->json(['error' => ['Não encontramos nenhum artigo']], 404);
    }


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
            return response()->json(['error' => [$validator->errors()]]);
        } else {
            $article = new Article();

            $article->title = $request->title;
            $article->description = $request->description;
            $article->status = ($request->draft == "on") ? 2 : 1;
            $article->tags = $request->tags;

            $url = title_parser($request->title);
            $exists = DB::table('articles')->where('url', $url)->first();
            if ($exists) {
                $currentID = (DB::table('articles')->orderByDesc('id')->first()->id + 1);
                $url = title_parser($url, $currentID);
            }
            $article->url = $url;

            $text = article_text_to_html($request->text);

            if ($request->file('image')) {
                $zip = new ZipArchive;
                $res = $zip->open($request->file('image'));
                if ($res === TRUE) {
                    $imgs_counter = $zip->numFiles;
                } else {
                    return response()->json(['error' => ['Ocorreu um erro com seu arquivo .zip']]);
                }

                check_num_of_article_imgs($text, $imgs_counter);

                $public_path = 'storage/articles/' . $url;
                $relative_path = 'storage/app/public/articles/' . $url;
                $path = base_path($relative_path);
                $zip->extractTo($path);

                $imgs_name = array_slice(scandir($path), 2);

                foreach ($imgs_name as $name) {
                    $ext = explode('.', $name)[1];
                    if (!in_array($ext, ['jpg', 'png', 'svg', 'jpeg', '.gif'])) {
                        $files = glob($path.'/*'); // get all file names
                        foreach ($files as $file) { // iterate files
                            if (is_file($file)) {
                                unlink($file); // delete file
                            }
                        }
                        abort(400, "As imagens no arquivo ip precisam ser do tipo jpg, png, svg, jpeg ou gif");
                    }
                }

                $text = article_img_treatment($text, $imgs_name, $public_path);
                $article->images_path = $public_path;
                $article->images_names = join(',', $imgs_name);
            }

            $article->formatted_text = $text;
            $article->unformatted_text = $request->text;
            $article->save();

            return response()->json(['success' => 'Você criou um artigo!']);
        }
    }

    public function logic_deletation($id){
        $id = (int)$id;
        $result = DB::table('articles')->where('id', $id)->update(['status' => '3']);
        if($id < 0 || $result == 0) return response()->json(['error'=>['id do artigo é inválido']], 400);
        return response()->json(['message'=>['Artigo deletado com sucesso, você pode vê-lo na lixeira']]);
    }
}
