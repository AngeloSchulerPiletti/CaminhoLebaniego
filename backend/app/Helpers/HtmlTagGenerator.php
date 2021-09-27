<?php


if(!function_exists('make_closer_html_tag')){
    function make_closer_html_tag($tag, $content, $class = " ", $attributes = " "){
        $html_tag = '<'.$tag.' class="'.$class.'" '.$attributes.' >'.$content.'</'.$tag.'>';
        return $html_tag;
    }
}



if(!function_exists('make_opened_html_tag')){
    function make_opened_html_tag($tag, $class = " ", $attributes = " "){
        $html_tag = '<'.$tag.' '.$class.' '.$attributes.' />';
        return $html_tag;
    }
}