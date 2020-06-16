<?php

namespace Lib\Controller;

use Lib\Http\Request;
use Lib\Http\Response;

abstract class Controller
{
    /**
     * Request Class.
     */
    public $request;

    /**
     * Response Class.
     */
    public $response;

    /**
     *  Construct
     */
    public function __construct() {
        $this->request = $GLOBALS['request'];
        $this->response = $GLOBALS['response'];
    }

    // send response faster
    public function send($status = 200, $msg) {
        $this->response->setHeader(sprintf('HTTP/1.1 ' . $status . ' %s' , $this->response->getStatusCodeText($status)));
        $this->response->setContent($msg);
    }
}