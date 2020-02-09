<?php

require 'phpQuery-onefile.php';


function print_arr($array) {
    echo '<pre>' . print_r($array, true) . '</pre>';
}
/*$pattern = '#<div class="table.+?</div>#s';
preg_match($pattern, $file, $matches);
print_r($matches);*/


/*$tr = $doc->find('.tab .currency-list__body tr:eq(2) td:eq(1)')->text();
echo($tr);*/

function get_content($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

function parser($url, $start, $end)
{
    if ($start < $end) {
        /*$file = file_get_contents($url);*/
        $file = get_content($url);
        $doc = phpQuery::newDocument($file);
        foreach ($doc->find('.post-list .post-list-item') as $article) {
            //pq = $
            $article = pq($article);
            $article->find('.post-category')->prepend('Category: ');
            $article->find('.post-category')->wrap('<div class="category">')->after('Дата: ' . date("Y-m-d H:i:s"));
            $image = $article->find('.post-image')->attr('style');
            //Парсинг div с атрибутом style="background-image:url"
            $imgUrl = preg_match('~url\((?P<img_url>.+?)\)~', $image, $match);
            $img = $match['img_url'];
            $text = $article->find('.post-content')->html();
            echo "<img src='$img'>";
            echo '<hr>';
            echo $text;
            echo '<hr>';
        }

        $next = $doc->find('.pagination .active .page-link')->parent()->next()->children('a')->attr('href');
        if (!empty($next)) {
            $start++;
            parser($next, $start, $end);
        }
    }
}

$url = 'https://www.kolesa.ru/news/';
$start = 0;
$end = 3;
parser($url, $start, $end);

/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_exec($ch);
curl_close($ch);*/

/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);*/

/*$file = fopen("file.txt", "w");
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_FILE, $file);
$res = curl_exec($ch);
curl_close($ch);
var_dump($res);*/

/*$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
var_dump($res);*/