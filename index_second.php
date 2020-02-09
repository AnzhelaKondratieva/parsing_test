<?php

require_once __DIR__ . '/Parser.php';

$url_auth = ''; //url авторизации
$url = '';  //url закрытого контента
$auth_data = [
    'log' => 'admin',
    'pwd' => 'admin',
    'rememberme' => 'on'
];

$parser = new Parser();
$parser->set(CURLOPT_POST, true)
        ->set(CURLOPT_POSTFIELDS, http_build_query($auth_data))
        ->set(CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt')
        ->set(CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');

$data = $parser->exec($url_auth);
$data = $parser->exec($url);