<?php

require 'phpQuery-onefile.php';

$url = 'https://www.kolesa.ru/news';
$file = file_get_contents($url);

function print_arr($array) {
    echo '<pre>' . print_r($array, true) . '</pre>';
}
/*$pattern = '#<div class="table.+?</div>#s';
preg_match($pattern, $file, $matches);
print_r($matches);*/

$doc = phpQuery::newDocument($file);
/*$tr = $doc->find('.tab .currency-list__body tr:eq(2) td:eq(1)')->text();
echo($tr);*/
foreach($doc->find('.post-list .post-list-item') as $article) {
    //pq = $
    $article = pq($article);
    $article->find('.post-category')->prepend('Category: ');
    $article->find('.post-category')->wrap('<div class="category">')->after('Дата: ' . date("Y-m-d H:i:s"));
    $image = $article->find('.post-image')->attr('style');
    //Парсинг div  атрибутом style="background-image:url"
    $imgUrl = preg_match('~url\((?P<img_url>.+?)\)~', $image, $match);
    $img = $match['img_url'];
    $text = $article->find('.post-content')->html();
    echo "<img src='$img'>";
    echo '<hr>';
    echo $text;
    echo '<hr>';
}

?>