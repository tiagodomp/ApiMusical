<?php


namespace App\Http\Controllers;

use Lib\Controller\Controller;
use App\User;
use Lib\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

    }

    public function show(Request $request)
    {
        return response()->toJson($request->auth()->user());
    }

    public function create(Request $request)
    {
        if(!$request->isValid('users.create'))

        $user = new User();
        $user->id();
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->img      = $request->files;
        $user->save();

        return response()->status(201)->toJson(['msg' => 'Sucesso']);
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

}