<?php

namespace App;

use Lib\Model\Model;

class Artist extends Model
{
    protected $table = 'artist';

    private $id;

    public $name;

    public $wow;

    public $sad;

}