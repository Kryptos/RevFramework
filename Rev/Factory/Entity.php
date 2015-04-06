<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Factory \ Entity
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Factory;

use Rev;

class Entity
{
    public function create($module)
    {
        if (file_exists(MODULE . DIRECTORY_SEPARATOR . ucfirst($module) . DIRECTORY_SEPARATOR . 'DataMapper' . DIRECTORY_SEPARATOR . ucfirst($module) . '.php')) {

        	require MODULE . DIRECTORY_SEPARATOR . ucfirst($module) . DIRECTORY_SEPARATOR . 'DataMapper' . DIRECTORY_SEPARATOR . ucfirst($module) . '.php';

            $Entity = "\\Module\\" . ucfirst($module) . "\\DataMapper\\" . ucfirst($module);

        	return new $Entity;
        }
    }
}
