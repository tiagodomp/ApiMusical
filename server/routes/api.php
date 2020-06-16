<?php

$router->get('/', 'MusicsController@index')->middleware('auth');