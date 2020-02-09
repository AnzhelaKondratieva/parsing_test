<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.02.2020
 * Time: 13:37
 */

class Parser
{
    private $url;
    private $ch;

    public function __construct($print = false){
        $this->ch = curl_init();
        if(!$print) {
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        }
    }

    public function __set($name, $value) {
        curl_setopt($this->ch, $name, $value);
        return $this;
    }

    public function exec($url){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return curl_exec($this->ch);
    }

    public function __destruct() {
        curl_close($this->ch);
    }
}