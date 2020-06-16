<?php

namespace App;

use Lib\Model\Model;

class Music extends Model
{
    protected $table = 'music';

    private $uuid;

    protected $artist_id;

    public $title;

    public $youtube;

    public $like;
}