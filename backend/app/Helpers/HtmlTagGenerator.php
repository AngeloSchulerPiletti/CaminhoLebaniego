<?php


if (!function_exists('attr_arr_to_attr_html')) {
    function attr_arr_to_attr_html($attributes){
        $attrs = " ";
        foreach ($attributes as $att => $value) {
            $attrs .= ' '.$att.'="'.$value.'"';
        }
        return $attrs;
    }
}


if(!function_exists('make_closer_html_tag')){
    function make_closer_html_tag($tag, $content, $class = " ", $attributes = " "){
        $html_tag = '<'.$tag.' class="'.$class.'" '.$attributes.' >'.$content.'</'.$tag.'>';
        return $html_tag;
    }
}


if(!function_exists('make_opened_html_tag')){
    function make_opened_html_tag($tag, $class = " ", $attributes = " "){
        $html_tag = '<'.$tag.' class="'.$class.'" '.$attributes.' />';
        return $html_tag;
    }
}