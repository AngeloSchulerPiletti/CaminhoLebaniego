<?php 

/*
 * dd() with headers
 */
if (!function_exists('ddh')) {
    function ddh($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd($var);
    }
}

/*
 * dump() with headers
 */
if (!function_exists('dumph')) {
    function dumph($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dump($var);
    }
}