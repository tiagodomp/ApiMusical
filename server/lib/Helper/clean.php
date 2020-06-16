<?php

if(!function_exists('clean')){
    function clean($data)
    {
        return trim(htmlspecialchars($data, ENT_COMPAT, 'UTF-8'));
    }
}

if(!function_exists('cleanUrl')) {
    function cleanUrl($url)
    {
        return str_replace(['%20', ' '], '-', $url);
    }
}