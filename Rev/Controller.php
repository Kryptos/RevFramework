<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Controller
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class Controller
{

    public $View;
    public $Model;
    public $Session;
    public $Log;

    public function __construct($Composer = null)
    {
        $this->View = new View();
        $this->Model = new Model();

        if($Composer != null) {
            $this->loadSession();
            $this->setRouting($Composer);
        }
    }

    public function loadModule($module)
    {
        $Instance = new \stdClass;

        $Instance->Controller = $this->loadController($module);
        $Instance->Model = $this->loadModel($module);

        return $Instance;
    }

    public function loadController($module)
    {
        $Controller = '\\Module\\' . $module . '\\' . $module . 'Controller';
        return new $Controller();
    }

    public function loadModel($module)
    {
        $Model = '\\Module\\' . $module . '\\' . $module . 'Model';
        return new $Model(new Factory\Entity(), new Factory\Mapper());
    }

    private function loadSession()
    {
        $this->Session = new Session;
    }

    private function setRouting($Composer)
    {
        $Composer->add(Configure::$Config->site->theme, THEME);
        $Composer->add('Module', APP);
    }
}
