<?php


namespace Lib\Http;


use Lib\Middleware\Middleware;

class Response
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $statusTexts = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required',
    ];

    /**
     * @var
     */
    protected $version;

    /**
     * @var
     */
    protected $content;

    /**
     * @var
     */
    private $middlewares;

    /**
     * @var
     */
    private $status;

    /**
     * Response constructor.
     */
    public function __construct(array $data = [])
    {
        $this->setVersion('1.1');
        $this->setHeader('Access-Control-Allow-Origin: *');
        $this->setHeader("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->setHeader('Content-Type: application/json; charset=UTF-8');
        $this->status(200);
    }

    /**
     *  Set the Http protocol version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     *  Get the Http protocol version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * define messages
     *
     * @param string $msg
     * @return $this
     */
    public function message($msg)
    {
        $this->content['msg'] = $msg;

        return $this;
    }

    /**
     * send a message
     * @param string $msg
     */
    public function sendMessage($msg)
    {
        $this->message($msg)->render();
    }

    /**
     * define status
     * @param $statusCode
     * @return $this
     */
    public function status($statusCode)
    {
        $this->status = (int) $this->isInvalid((int) $statusCode)? 0 : $statusCode;
        return $this;
    }

    /**
     * insert status in header
     * @return $this
     */
    private function defStatus()
    {
        if (!$this->isInvalid($this->status))
            $this->setHeader(sprintf('HTTP/1.1 ' . $this->status . ' %s' , $this->getStatusCodeText($this->status)));

        return $this;
    }

    /**
     *  Get the status code text.
     *
     * @param int $code
     * @return string
     */
    public function getStatusCodeText($code = 0)
    {
        if($code == 0)
            $code = $this->status;

        return (string) isset($this->statusTexts[$code]) ? $this->statusTexts[$code] : 'status não encontrado';
    }

    /**
     *  Set the response Headers.
     *
     * @param $header
     */
    public function setHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     *  Get the response Headers.
     *
     * @return array
     */
    public function getHeader() {
        return $this->headers;
    }

    /**
     *  Set content response.
     *
     * @param array $content
     */
    public function setContent(array $content) {
        $this->content['data'] = $content;
        $this->render();
    }

    /**
     *  Get content response.
     *
     * @return mixed
     */
    public function getContent() {
        return $this->content['data']?:[];
    }

    /**
     * redirect to url
     * @param $url
     */
    public function redirect($url) {
        if (empty($url)) {
            trigger_error('Não é possivel redirecionar para uma URL vazia');
            exit;
        }

        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&','', ''), $url), true, 302);
        exit();
    }

    /**
     *  check status code is invalid
     *
     * @return bool
     */
    public function isInvalid($statusCode){
        return is_int($statusCode) && ($statusCode < 100 || $statusCode >= 600);
    }

    /**
     * send a content
     * @param array $data
     */
    public function toJson(array $data) {
        $this->content['data'] = $data;
        $this->render();
    }

    private function standardize(){

        if (!array_key_exists('code', $this->content) || empty($this->content['code']))
            $this->content['code'] = $this->status;

        if (!array_key_exists('msg', $this->content) || empty($this->content['msg']))
            $this->content['msg'] = $this->getStatusCodeText();

        if (!array_key_exists('data', $this->content) || empty($this->content['data']))
            $this->content['data'] = [];

        if (!is_array($this->content['data']) && !is_object($this->content['data']))
            $this->content['data'] = [$this->content['data']];

        return $this;
    }

    public function setMiddleware($name, $middleware)
    {
        if(class_exists($middleware))
            $this->middlewares[$name] = new $middleware($this);

        return $this;
    }

    /**
     *  Render Output
     */
    public function render() {
        $this->defStatus()
                ->standardize();

        // Headers
        if (!headers_sent()) {
            foreach ($this->headers as $header) {
                header($header, true);
            }
        }

        echo json_encode($this->content);
        exit;
    }
}