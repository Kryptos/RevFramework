<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework: Bootstrap
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

    define('ROOT',  getcwd());
    $Composer = require_once ROOT . DIRECTORY_SEPARATOR . 'Rev' . DIRECTORY_SEPARATOR . 'Plugins' . DIRECTORY_SEPARATOR . 'autoload.php';
    new Rev\Rev($Composer);
