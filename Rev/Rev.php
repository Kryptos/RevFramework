<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Rev
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class Rev
{

    const SYSTEM = 'Rev';
    const VERSION = '1.0';
    const AUTHOR = 'Kryptos';
    const LICENSE = 'MIT';
    const REPOSITORY = 'https://github.com/Kryptos/Rev';

    public $Controller;

    public function __construct($Composer)
    {
        $this->startLogging();
        $this->loadConfiguration();
        $this->checkPHPVersion(Configure::$Config->rev->php)->setEnvironment(Configure::$Config->site->production)->setFolders()->setTimezone();
        $this->loadController($Composer);
    }

    private function startLogging()
    {
        return new \Kryptos\Handler\Error;
    }

    private function loadConfiguration()
    {
        return new Configure;
    }

    private function loadController($Composer)
    {
        $this->Controller = new Controller($Composer);
    }

    private function checkPHPVersion($php)
    {
        if (version_compare(PHP_VERSION, $php, '<')) {
            trigger_error('Rev requires PHP ' . REQUIRE_PHP_VERSION . ' or greater');
        }

        return $this;
    }

    private function setEnvironment($production)
    {
        if ($production == true) {
            error_reporting(E_USER_ERROR);
        }

        return $this;
    }

    private function setTimezone($timezone = 'America/New_York')
    {
        date_default_timezone_set($timezone);
        return $this;
    }

    private function setFolders()
    {
        define('DS', DIRECTORY_SEPARATOR);

        define('REV', ROOT . DS . 'Rev');
            define('HELPER', REV . DS . 'Helpers');
            define('PLUGIN', REV . DS . 'Plugins');
            define('DATAMAPPER', REV . DS . 'DataMapper');

        define('APP', SITE . DS . Configure::$Config->rev->site);
            define('MODULE', APP . DS . 'Module');
            define('THEME', APP . DS . 'Theme');
                define('PAGEDATA', THEME . DS . Configure::$Config->site->theme);
            define('VIEW', APP . DS . 'Public' . DS . Configure::$Config->site->theme);

        return $this;
    }
}
