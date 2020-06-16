<?php

namespace App;

use Lib\Model\Model;

class User extends Model
{
    protected $table = 'user';

    private $id;

    public $name;

    public $email;

    public $img;

}