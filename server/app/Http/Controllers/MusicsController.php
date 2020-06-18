<?php


namespace App\Http\Controllers;

use Lib\Controller\Controller;

class MusicsController extends Controller
{
    /**
     * @OA\Info(title="Controladora de Musicas", version="0.1")
     */

    /**
     * @OA\Get(
     *     path="/api/resource.json",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
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

    public function artist()
    {
        $data = ['music' => 'artist'];
        return response()->toJson($data);
    }

    public function create()
    {
        $data = ['music' => 'create'];
        return response()->toJson($data);
    }

    public function update($uuid)
    {
        $data = ['music' => 'update', $uuid];
        return response()->toJson($data);
    }

    public function like($uuid)
    {
        $data = ['music' => 'like', $uuid];
        return response()->toJson($data);
    }

    public function delete($uuid)
    {
        $data = ['music' => 'delete', $uuid];
        return response()->toJson($data);
    }
}