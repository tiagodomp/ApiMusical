<?php


namespace Lib\Http;


use Lib\Middleware\Middleware;

class Request
{
    public $cookie;

    /**
     *  Get REQUEST Super Global
     * @var
     */
    public $request;

    /**
     *  Get FILES Super Global
     * @var
     */
    public $files;

    /**
     *
     */
    private $middlewares;

    /**
     *  errors of request
     *  @var array
     */
    private $errors;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request = ($_REQUEST);
        $this->cookie = $this->clean($_COOKIE);
        $this->files = $this->clean($_FILES);
        $this->defPropertys();
    }

    /**
     *  Get $_GET parameter
     *
     * @param string $key
     * @return string
     */
    public function get($key = '')
    {
        if ($key != '')
            return isset($_GET[$key]) ? $this->clean($_GET[$key]) : null;

        return  $this->clean($_GET);
    }

    /**
     *  Get $_POST parameter
     *
     * @param String $key
     * @return string
     */
    public function post($key = '')
    {
        if ($key != '')
            return isset($_POST[$key]) ? $this->clean($_POST[$key]) : null;

        return  $this->clean($_POST);
    }

    public function all()
    {
        return $this->request;
    }

    /**
     *  Get POST parameter
     *
     * @param String $key
     * @return string
     */
    public function input($key = '')
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        if ($key != '') {
            return isset($request[$key]) ? $this->clean($request[$key]) : null;
        }

        return ($request);
    }

    /**
     *  Get value for server super global var
     *
     * @param string $key
     * @return array|string
     */
    public function server($key = '')
    {
        if(empty($key))
            return (array) $this->clean($_SERVER);

        if(!isset($_SERVER[strtoupper($key)]))
            return '';

        return (string) $this->clean($_SERVER[strtoupper($key)]);
    }

    /**
     *  Get Method
     *
     * @return string
     */
    public function getMethod() {
        return (string) strtoupper($this->server('REQUEST_METHOD'));
    }

    /**
     *  Returns the client IP addresses.
     *
     * @return string
     */
    public function getClientIp()
    {
        return (string) $this->server('REMOTE_ADDR');
    }

    /**
     *  get params of $GLOBAL
     *
     * @return string
     */
    public function getParams()
    {
        return $this->server('QUERY_STRING');
    }

    /**
     *  get path of $GLOBAL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->server('PATH_INFO');
    }

    /**
     * Clean Data
     *
     * @param $data
     * @return string
     */
    private function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {

                // Delete key
                unset($data[$key]);

                // Set new clean key
                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }

    private function defPropertys()
    {
        if(!empty($this->request))
            foreach ($this->request as $key => $value)
                if(!array_key_exists($key, get_object_vars($this)))
                    $this->$key = $value;
    }
}