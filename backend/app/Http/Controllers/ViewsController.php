<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    protected const ACCEPTED_PAGES = ["inicio", "preparacao", "caminho", "experiencia", "artigos", "contato", "search_result"]; 

    public function getPageContent($pageContent)
    {
        if (!in_array($pageContent, $this::ACCEPTED_PAGES)) {
            abort(404, "Por favor, corrija a URL de destino da requisição para a API.");
        }
        $pageData = [];
        switch ($pageContent) {
            case 'inicio':
                $pageData['title'] = "Descubra o Caminho";
                $pageData['paragraph'] = "Por mais longa que seja a caminhada, o mais importante é dar o primeiro passo.";
                $pageData['modal'][0] = getHTMLFromMD("modais/inicio_history.md");
                $pageData['modal'][1] = ["Ler mais Artigos" => "/artigos"];
                break;

            case 'preparacao':
                $pageData['title'] = "Prepare-se";

                $topicsListsArr = getJsonAsArray('preparacao/topicsList.json');
                $pageData['topicsList'] = [$topicsListsArr, count($topicsListsArr)];
                break;

            case 'caminho':
                $pageData['title'] = "O que estará a sua frente";
                $sliderParagraphsArr = explodeParagraphsFromTXT("caminho/sliderParagraphs.txt");
                $pageData["sliderParagraphs"] = [$sliderParagraphsArr, count($sliderParagraphsArr)];

                $sliderImagesArr = getJsonAsArray('caminho/sliderImages1.json');
                $pageData["sliderImages1"] = [$sliderImagesArr, count($sliderImagesArr)];
                
                $dailyExcerptsArr = getJsonAsArray('caminho/dailyExcerpts.json');
                $pageData["dailyExcerpts"] = [$dailyExcerptsArr, count($dailyExcerptsArr['content'])];

                $observationsArr = getJsonAsArray('caminho/observations.json');
                $pageData["observations"] = [$observationsArr, count($observationsArr)]; 

                $trekObservationsArr = getJsonAsArray('caminho/trekObservations.json');
                $pageData["trekObservations"] = [$trekObservationsArr, count($trekObservationsArr['content'])]; 
                break;

            case 'experiencia':
                $pageData['title'] = "Experiência Pessoal";

                $pageData["article"] = file_get_contents(base_path('resources/html/experiencia/experiencia.html'));
                break;

            case 'artigos':
                $pageData['title'] = "Para você saber ainda mais";
                break;

            case 'contato':
                $pageData['title'] = "Quer perguntar algo?";
                break;

            
            case 'search_result':
                $pageData['title'] = "Aqui está o resultado de suas buscas";
                break;

            default:
                # code...
                break;
        }
        return $pageData;
    }
}
