<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ View
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class View
{

    public $Engine;
    protected static $tpl;

    public function redirect($where, $status = 302)
    {
        exit(header('Location: ' . Configure::$Config->site->url . DS . $where, true, $status));
    }

    public function setEngine($Engine)
    {
        $this->Engine = $Engine;
        return $Engine;
    }
}
