<?php

require_once 'clean.php';
require_once 'array.php';
require_once 'string.php';

if(!function_exists('env')) {
    function env($campo, $value = null)
    {
        if (1 == 1)
            return true;
    }
}

if(!function_exists('response')){
    function response(){
        return $GLOBALS['response'];
    }
}

if(!function_exists('request')){
    function request(){
        return $GLOBALS['request'];
    }
}

if(!function_exists('router')){
    function router(){
        return $GLOBALS['router'];
    }
}

if(!function_exists('swagger')){
    function swagger(){
        return $GLOBALS['swagger'];
    }
}

if(!function_exists('dd')){
    function dd($data = ''){
        var_dump($data);
        exit;
    }
}

if(!function_exists('dump')){
    function dump($data = ''){
        var_dump($data);
    }
}

if(!function_exists('app_path')){
    function app_path($file = ''){
        return path_file('/app/', $file);
    }
}

if(!function_exists('config_path')){
    function config_path($file = ''){
        return path_file('/config/', $file);
    }
}

if(!function_exists('public_path')){
    function public_path($file = ''){
        return path_file('/public/', $file);
    }
}


if(!function_exists('storage_path')){
    function storage_path($file = ''){
        return path_file('/storage/', $file);
    }
}

if(!function_exists('img_path')){
    function img_path($img = ''){
        return path_file('/public/images/', $img);
    }
}

if(!function_exists('music_path')){
    function music_path($music = ''){
        return path_file('/public/musics/', $music);
    }
}

if(!function_exists('base_path')){
    function base_path(){
        return substr(__DIR__, 0, - strlen('/lib/Helper'));
    }
}

if(!function_exists('path_file')){
    function path_file($path, $file){
        $path = strStart($path, base_path())? $path : base_path() . $path;

        if(!empty($file))
            return is_file($path.$file)?$path.$file:'';

        return $path;
    }
}



