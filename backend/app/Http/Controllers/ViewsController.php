<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function getPageContent($pageContent)
    {
        $pageData = [];
        switch ($pageContent) {
            case 'inicio':
                $pageData['title'] = "Descubra o Caminho";
                $pageData['paragraph'] = "Por mais longa que seja a caminhada, o mais importante é dar o primeiro passo.";
                $pageData['modal'][0] = file_get_contents(base_path("resources/html/modalContent/HistoriaDoCaminho.html"));
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

                // $observationsArr = getJsonAsArray('caminho/observations.json');
                // $pageData["observations"] = [$observationsArr, count($observationsArr)]; 

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
                return response()->json(['error' => ['Por favor, corrija a URL de destino da requisição para a API.']]);
                break;
        }
        return $pageData;
    }

    public function getModalAdminInfo($field){
        $modalData = [];
        switch ($field) {
            case 'title':
                $modalData['title'] = "Título";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/title.html'));
                break;
                
            case 'description':
                $modalData['title'] = "Descrição";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/description.html'));
                break;
                
            case 'article':
                $modalData['title'] = "O Artigo";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/article.html'));
                break;
                
            case 'tags':
                $modalData['title'] = "Tags do Artigo";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/tags.html'));
                break;
                
            case 'draft':
                $modalData['title'] = "Rascunho";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/draft.html'));
                break;
                
            case 'images':
                $modalData['title'] = "Imagens";
                $modalData['paragraphs'] = file_get_contents(base_path('resources/html/infoModal/images.html'));
                break;
            
            default:
                return response()->json(['error' => ['Por favor, corrija a URL de destino da requisição para a API.']]);
                break;
        }
        
        return response()->json(['infoModal' => $modalData]);
    }
}
