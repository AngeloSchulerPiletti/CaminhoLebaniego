<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;

class ViewsController extends Controller
{
    protected const ACCEPTED_PAGES = ["inicio", "preparacao", "caminho", "experiencia", "artigos", "contato"];

    protected function getHTMLFromMD($md_path){
        $mdParser = new Parsedown();
        return $mdParser->text(file_get_contents(base_path('resources/markdown/'.$md_path)));
    }

    public function getPageContent($pageContent)
    {
        if (!in_array($pageContent, $this::ACCEPTED_PAGES)) {
            abort(404, "Por favor, corrija a URL de destino da requisição para a API.");
        }
        $pageData = [
            "title" => "",
            "paragraph" => "",
            "modal" => [
                "",
                [
                    // "route_name" => "route",
                ],
            ],
        ];
        switch ($pageContent) {
            case 'inicio':
                $pageData['title'] = "Descubra o Caminho";
                $pageData['paragraph'] = "Por mais longa que seja a caminhada, o mais importante é dar o primeiro passo.";
                $pageData['modal'][0] = $this->getHTMLFromMD("modais/inicio_history.md");
                $pageData['modal'][1] = ["Ler mais Artigos", "/artigos"];
                break;

            case 'preparacao':
                $pageData['title'] = "Prepare-se";
                break;

            case 'caminho':
                $pageData['title'] = "O que estará a sua frente";
                break;

            case 'experiencia':
                $pageData['title'] = "Experiência Pessoal";
                break;

            case 'artigos':
                $pageData['title'] = "Para você saber ainda mais";
                break;

            case 'contato':
                $pageData['title'] = "Quer perguntar algo?";
                break;

            default:
                # code...
                break;
        }
        return $pageData;
    }
}
