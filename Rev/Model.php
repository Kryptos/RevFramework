<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Model
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class Model
{

    public $Driver;
    public static $queries = 0;

    public function __construct()
    {
        require_once DATAMAPPER . DS . 'AbstractEntity.php';
        require_once DATAMAPPER . DS . 'AbstractMapper.php';
    }

    public function setDriver($driver)
    {
        $this->Driver = new $driver();
        return $this->Driver;
    }
}
