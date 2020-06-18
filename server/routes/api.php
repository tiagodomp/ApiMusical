<?php

/**
 * Routes of Users
 */
$router->get('/',               'UsersController@index');
$router->get('/user/{id}',      'UsersController@show')     ->middleware('auth');
$router->get('/check',          'UsersController@check');
$router->post('/login',         'UsersController@login');
$router->post('/register',      'UsersController@register');
$router->post('/user',         'UsersController@create');
$router->put('/user/{id}',      'UsersController@update')   ->middleware('auth');
$router->delete('/user/{id}',   'UsersController@delete')   ->middleware('auth');

/**
 * Routes of Musics
 */
$router->get('/musics',             'MusicsController@index')   ->middleware('auth');
$router->get('/musics/{uuid}',      'MusicsController@show')    ->middleware('auth');
$router->get('/music/artist',       'MusicsController@artist')  ->middleware('auth');
$router->post('/music',             'MusicsController@create')  ->middleware('auth');
$router->put('/music/{uuid}',       'MusicsController@update')  ->middleware('auth');
$router->put('/music/like/{uuid}',  'MusicsController@like')    ->middleware('auth');
$router->delete('/music/{uuid}',    'MusicsController@delete')  ->middleware('auth');

/**
 * Routes of Artists
 */
$router->get('/artists',            'ArtistsController@index')      ->middleware('auth');
$router->get('/artists/{id}',       'ArtistsController@show')       ->middleware('auth');
$router->get('/artist/musics',      'ArtistsController@getMusic')   ->middleware('auth');
$router->get('/artist/music/{uuid}','ArtistsController@showMusic')  ->middleware('auth');
$router->post('/artist',            'ArtistsController@create')     ->middleware('auth');
$router->post('/artist/music',      'ArtistsController@createMusic')->middleware('auth');
$router->put('/artist/{id}',        'ArtistsController@update')     ->middleware('auth');
$router->put('/artist/wow/{id}',    'ArtistsController@wow')        ->middleware('auth');
$router->put('/artist/sad/{id}',    'ArtistsController@sad')        ->middleware('auth');
$router->delete('/artist/{id}',     'ArtistsController@delete')     ->middleware('auth');
