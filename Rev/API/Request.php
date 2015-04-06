<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Api \ Request
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\API;

class Request
{

    public $vars = array();
    public $method;
    public $referer;
    public $input;

    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        $this->setReferer(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        $this->setMethod($_SERVER['REQUEST_METHOD']);

        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->setMethod('DELETE');
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->setMethod('PUT');
            }
        }

        $this->processRequest();
    }

    private function processRequest()
    {
        switch ($this->method) {
            case 'GET':
                $this->setVars($_GET);
                break;
            case 'POST':
            case 'DELETE':
                $this->setVars($_POST);
                break;
            case 'PUT':
                $this->setVars($_GET);
                $this->setInput();
            default:
                trigger_error('Request method is not supported.');
                break;
        }
    }

    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=="xmlhttprequest") ? true : false;
    }

    public function setVars(array $vars = array())
    {
        $this->vars = array_filter(array_map('trim', array_map('strip_tags', $vars)));
    }

    public function setInput($input)
    {
        $this->input = file_get_contents("php://input");
    }

    public function __call($method, $params)
    {
        if (!method_exists($method) && preg_match( "|^[gs]et([A-Z][\w]+)|", $method, $matches)) {
            $var = strtolower($matches[1]);
            $properties = new ReflectionClass($this)->getdefaultProperties();

            if(array_key_exists($var,$properties)) {
                if ('s' == $method[0])) {
                    $this->$var = $params[0];
                }
                elseif ('g' == $method[0]) {
                    return $this->$var;
                }
            }
        }
    }
}
