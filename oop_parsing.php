<?php

require 'phpQuery-onefile.php';


function print_arr($array) {
    echo '<pre>' . print_r($array, true) . '</pre>';
}

function get_content($url, $data = []) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

$url_auth = ''; //url авторизации
$url = '';  //url закрытого контента
$auth_data = [
    'log' => 'admin',
    'pwd' => 'admin',
    'rememberme' => 'on'
];

$data = get_content($url_auth, $auth_data);
$data = get_content($url);