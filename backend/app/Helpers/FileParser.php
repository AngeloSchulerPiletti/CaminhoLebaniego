<?php

if (!function_exists('getHTMLFromMD')) {
    function getHTMLFromMD($md_path)
    {
        $mdParser = new Parsedown();
        return $mdParser->text(file_get_contents(base_path('resources/markdown/' . $md_path)));
    }
}

if (!function_exists('explodeParagraphsFromTXT')) {
    function explodeParagraphsFromTXT($txt_path)
    {
        $paragraphs = preg_split('/[\n\r]/', file_get_contents(base_path('resources/texts/' . $txt_path)));
        return array_values(array_filter($paragraphs));
    }
}

if(!function_exists('getJsonAsArray')){
    function getJsonAsArray($json_path){
        return json_decode(file_get_contents(base_path('resources/json/'.$json_path)), true);
    }
}