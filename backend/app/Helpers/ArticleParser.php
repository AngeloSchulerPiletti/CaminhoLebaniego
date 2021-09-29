<?php

/**
 * Title Parser to URL encode
 */
if (!function_exists('title_parser')) {
    function title_parser($title, $id = null)
    {
        $changes = array(
            'Š' => 's', 'š' => 's', 'Ð' => 'dj', '' => 'z', '' => 'z', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ã' => 'a', 'Ä' => 'a',
            'Å' => 'a', 'Æ' => 'a', 'Ç' => 'c', 'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i',
            'Ï' => 'i', 'Ñ' => 'n', 'Ń' => 'n', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o', 'Ø' => 'o', 'Ù' => 'u',
            'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ý' => 'y', 'Þ' => 'b', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
            'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
            //Another Chars
            ' ' => '-', '!' => '', '?' => '', '+' => '', '/' => '-', '"' => '', "'" => '', '*' => '', '&' => '', '@' => '', '#' => '',
            '(' => '', ')' => '', '¨' => '', ',' => '', '.' => '', '§' => '', '%' => '', '<' => '', '>' => '', '\\' => '', '|' => '',
            ':' => '-',
            //Uppercase to Lowercase
            'A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h', 'I' => 'i',
            'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n', 'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r',
            'S' => 's', 'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x', 'Y' => 'y', 'Z' => 'z',
        );

        $url = strtr($title, $changes);
        $url .= $id ? ('-' . $id) : "";
        return $url;
    }
}


if (!function_exists('tag_converter')) {
    function tag_converter($tags)
    {
        $changes = array(
            'Š' => 's', 'š' => 's', 'Ð' => 'dj', '' => 'z', '' => 'z', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ã' => 'a', 'Ä' => 'a',
            'Å' => 'a', 'Æ' => 'a', 'Ç' => 'c', 'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i',
            'Ï' => 'i', 'Ñ' => 'n', 'Ń' => 'n', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o', 'Ø' => 'o', 'Ù' => 'u',
            'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ý' => 'y', 'Þ' => 'b', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
            'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
            //Another Chars
            ' ' => '-', '!' => '', '?' => '', '+' => '', '/' => '-', '"' => '', "'" => '', '*' => '', '&' => '', '@' => '', '#' => '',
            '(' => '', ')' => '', '¨' => '', ',' => '-', '.' => '', '§' => '', '%' => '', '<' => '', '>' => '', '\\' => '', '|' => '',
            ':' => '',
            //Uppercase to Lowercase
            'A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h', 'I' => 'i',
            'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n', 'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r',
            'S' => 's', 'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x', 'Y' => 'y', 'Z' => 'z',
        );

        $tags = strtr($tags, $changes);
        return $tags;
    }
}


/**
 * Tag an string and transforms into a tag array
 * 
 * @param  String
 * 
 * @return Array
 */
if (!function_exists('tag_parser')) {
    function tag_parser($tags)
    {
        $resultArr = array_filter(explode('-', $tags));
        return $resultArr;
    }
}




if (!function_exists('article_text_to_html')) {
    function article_text_to_html($text)
    {
        $text .= "\u{000A}";

        $text = preg_replace_callback('/(<-)(.+)(->)/U', function ($matches) {
            return make_opened_html_tag('hr', $matches[2]);
        }, $text);

        $text = preg_replace_callback('/\$(.+)\[(.+)\]\$/U', function ($matches) {
            return make_closer_html_tag('a', $matches[1], " ", attr_arr_to_attr_html(['href' => $matches[2]]));
        }, $text);

        $text = preg_replace_callback('/([*]{2})(.+)([*]{2})/U', function ($matches) {
            return make_closer_html_tag('em', $matches[2]);
        }, $text);

        $text = preg_replace_callback('/([*]{1})(.+)([*]{1})/U', function ($matches) {
            return make_closer_html_tag('strong', $matches[2]);
        }, $text);

        $text = preg_replace_callback('/([#]{1,6})(.+)([\r\n]{1})/', function ($matches) {
            $counter = strlen($matches[1]);
            return make_closer_html_tag('h' . $counter, $matches[2]);
        }, $text);

        //  '/([-]{4}[\r\n]{1})([-]{1}(.+)[\r\n]{1})([-]{4}[\r\n]{1})/'
        $text = preg_replace_callback('/([-]{4}[\r\n]{1})(.+)([-]{4}[\r\n]{1})/Us', function ($matches) {
            $ul_items = preg_replace_callback('/([-]{1})(.+)([\r\n]{1})/U', function ($matches2) {
                return make_closer_html_tag('li', $matches2[2]);
            }, $matches[2]);
            return make_closer_html_tag('ul', $ul_items);
        }, $text);

        $text = preg_replace_callback('/(<![\r\n]{1})(.+)(!>[\r\n]{1})/Us', function ($matches) {
            $inside_p = preg_replace_callback('/(.+)[\r\n]{1}/', function ($matches2) {
                return make_closer_html_tag('p', $matches2[1], 'inside_p');
            }, $matches[2]);
            return make_closer_html_tag('div', $inside_p, "warn");
        }, $text);

        $text = preg_replace_callback('/(<\"[\r\n]{1})(.+)(\">[\r\n]{1})/Us', function ($matches) {
            $inside_p = preg_replace_callback('/(.+)[\r\n]{1}/', function ($matches2) {
                return make_closer_html_tag('p', $matches2[1], 'inside_p');
            }, $matches[2]);
            return make_closer_html_tag('div', $inside_p, "quotes");
        }, $text);



        $text = preg_replace_callback('/\@\@(.+)([\r\n]{1})/U', function ($matches) {
            return make_closer_html_tag('p', $matches[1]);
        }, $text);

        $text = preg_replace_callback('/\n/', function ($matches) {
            return make_opened_html_tag('br');
        }, $text);

        return $text;
    }
}


if (!function_exists('check_num_of_article_imgs')) {
    function check_num_of_article_imgs($text, $imgs_on_zip)
    {
        $result = preg_match_all('/<\/(.+)\/>/U', $text);
        if ($result != $imgs_on_zip) {
            abort(400, "O número de imagens no artigo não é o mesmo número de imagens enviadas");
        }
    }
}


if (!function_exists('article_img_treatment')) {
    function article_img_treatment($text, $imgs_name, $imgs_path)
    {
        $imgs_on_text = 0;
        $text = preg_replace_callback('/<\/(.+)\/>/U', function ($matches) use (&$imgs_on_text, $imgs_path, $imgs_name) {
            return make_opened_html_tag('img', $matches[1], attr_arr_to_attr_html(["src" => $imgs_path . '/' . $imgs_name[$imgs_on_text]]));
            $imgs_on_text++;
        }, $text);

        return $text;
    }
}



if (!function_exists('chared_string_to_array')) {
    function chared_string_to_array($articles, $property, $char, $more_than_one = false)
    {
        if ($more_than_one) {
            foreach ($articles as $article) {
                $article->$property = array_unique(array_filter(explode($char, $article->$property)));
            }
            return $articles;
        }

        $articles->$property = array_unique(array_filter(explode($char, $articles->$property)));
        return $articles;
    }
}
