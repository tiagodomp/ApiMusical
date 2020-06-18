<?php


namespace App\Http\Controllers;

use Lib\Controller\Controller;

class ArtistsController extends Controller
{
    public function index()
    {
        $data = ['A' => 'Bem Vindo'];
        return response()->toJson($data);
    }

    public function show($uuid)
    {
        $data = ['music' => 'show', $uuid];
        return response()->toJson($data);
    }

    public function getMusic()
    {
        $data = ['music' => 'show', $uuid];
        return response()->toJson($data);
    }

    public function showMusic($uuid)
    {
        $data = ['music' => 'show', $uuid];
        return response()->toJson($data);
    }

    public function create()
    {
        $data = ['music' => 'create'];
        return response()->toJson($data);
    }

    public function createMusic()
    {
        $data = ['music' => 'create'];
        return response()->toJson($data);
    }

    public function update($uuid)
    {
        $data = ['music' => 'update', $uuid];
        return response()->toJson($data);
    }

    public function wow()
    {
        $data = ['music' => 'wow'];
        return response()->toJson($data);
    }

    public function sad()
    {
        $data = ['music' => 'sad'];
        return response()->toJson($data);
    }

    public function delete($uuid)
    {
        $data = ['music' => 'delete', $uuid];
        return response()->toJson($data);
    }

}