<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

    define('SITE', __DIR__);
    require_once 'Rev/Bootstrap.php';

    /**
     * ------------------
     *  Klein
     * ------------------
     */
        $klein = new \Klein\Klein;

        $klein->respond('/', function ($request) {
            if(isset($GLOBALS['argv'])) {
                $class = Rev\Configure::$Config->site->theme . '\\'  . 'cli';
            } else {
                $class = Rev\Configure::$Config->site->theme . '\\'  . 'index';
            }

            new $class;
        });

        $klein->respond('/[:page]', function ($request) {
            $class = Rev\Configure::$Config->site->theme . '\\' . $request->page;
            new $class;
        });

        $klein->dispatch();
