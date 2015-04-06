<?php

namespace Kryptos\Handler;

class Error
{
    public function __construct()
    {
        set_error_handler(array($this, 'render'));
    }

    public function render($code, $msg, $file, $line, array $context = array())
    {
        ob_start();
        include(realpath(dirname(__FILE__)) . '/../../View/Error.html');
        $error .= ob_get_contents();
        ob_end_clean();

        echo $this->interpolate($error, array(
            'code' => $code,
            'msg' => $msg,
            'file' => $file,
            'line' => $line,
            'date' => date('D M Y', $_SERVER['REQUEST_TIME']),
            'time' => date('H:i:s', $_SERVER['REQUEST_TIME']),
            'urgent' => $_SERVER['HTTP_USER_AGENT'],
            'software' => $_SERVER['SERVER_SOFTWARE'],
            'ipaddr' => $_SERVER['SERVER_ADDR'],
            'port' => $_SERVER['SERVER_PORT'],
            'path' => $_SERVER['SCRIPT_FILENAME'],
            'uri' => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            'phpversion' => 'PHP' . PHP_VERSION . '(' . PHP_OS . ')'
        ));
        exit;
    }

    protected function interpolate($message, array $context = array())
    {
        $replace = array();
        foreach ($context as $key => $val) {
            $replace['{{' . $key . '}}'] = $val;
        }

        return strtr($message, $replace);
    }
}
