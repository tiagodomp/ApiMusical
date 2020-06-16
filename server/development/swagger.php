<?php

$swagger = \Swagger\scan('../app');
header('Content-Type: application/json');

require 'swagger-variables.php';