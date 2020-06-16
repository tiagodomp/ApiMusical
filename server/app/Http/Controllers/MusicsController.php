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

        dd($data);

        return response()->toJson($data);
    }
}