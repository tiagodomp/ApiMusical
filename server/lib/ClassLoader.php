<?php

function autoload($class) {
    // set file class

    if(preg_match('/^Lib/', $class))
        $class = (string) str_replace('Lib', '', $class);

    $file = __DIR__ . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)){
        require_once $file;
    }else {
        throw new Exception(sprintf('Class { %s } Não Encontrada!', $class));
    }
}

// set autoload function
spl_autoload_register('autoload');
