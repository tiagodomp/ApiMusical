<?php

use Rhumsaa\Uuid\Uuid;

if(!function_exists('startsWith')){
    function startsWith($string, $pattern)
    {
        if(!is_string($string))
            return false;

        return preg_match('/^'.strtolower($pattern).'/', strtolower($string))?true:false;
    }
}

if(!function_exists('endsWith')){
    function endsWith($string, $pattern)
    {
        if(!is_string($string))
            return false;

        return preg_match('/'.strtolower($pattern).'$/', strtolower($string))?true:false;
    }
}

if(!function_exists('strStart')){
    function strStart($string, $haystack)
    {
        if(startsWith($string, $haystack))
            return $string;

        return $haystack.$string;
    }
}

if(!function_exists('strEnd')){
    function strEnd($string, $haystack)
    {
        if(endsWith($string, $haystack))
            return $string;

        return $string.$haystack;
    }
}
if(!function_exists('is_json')) {
    function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if(!function_exists('strContain')){
    function strContain($string, $haystack)
    {
        $pos = strpos($string, $haystack);
        $pos === false?false:true;
    }
}

if(!function_exists('dotForCamel')){
    function dotForCamel($string)
    {
        $camel = '';
        foreach(explode('.', $string) as $str)
            $camel .= ucfirst($str);

        return !empty($camel)?$camel:$string;
    }
}

if(!function_exists('uuid')) {
    function uuid()
    {
        return Uuid::uuid4();
    }
}

if(!function_exists('strUuid')) {
    function strUuid()
    {
        return Uuid::uuid4()->toString();
    }
}

if(!function_exists('is_uuid')) {
    function is_uuid($uuid)
    {
        return preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $uuid) ? true : false;
    }
}

if(!function_exists('is_email')) {
    function is_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL)?true:false;
    }
}