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

    public function show($id)
    {
        $data = ['user' => 'show', $id];
        return response()->toJson($data);
        //return response()->toJson($request->auth()->user());
    }

    public function check()
    {
        $data = ['user' => 'check'];
        return response()->toJson($data);
    }

    public function create()
    {
        if(!$this->request->isValid('users.create'))
            return response()->status(412)->sendMessage(request()->errors());

        $user = new User();
        $user->id();
        $user->name     = request()->name;
        $user->email    = request()->email;
        $user->img      = request()->img;
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