<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Factory \ Mapper
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Factory;

use Rev;

class Mapper
{
    public function create($Module, $Driver)
    {
        if (file_exists(MODULE . DIRECTORY_SEPARATOR . ucfirst($Module) . DIRECTORY_SEPARATOR . 'DataMapper' . DIRECTORY_SEPARATOR . ucfirst($Module) . 'Mapper.php')) {
        	require MODULE . DIRECTORY_SEPARATOR . ucfirst($Module) . DIRECTORY_SEPARATOR . 'DataMapper' . DIRECTORY_SEPARATOR . ucfirst($Module) . 'Mapper.php';

            $Mapper = "\\Module\\" . ucfirst($Module) . "\\DataMapper\\" . ucfirst($Module) . 'Mapper';
        	$Mapper = new $Mapper($Driver);

        	$this->setRelations($Mapper, $Driver);

            return $Mapper;
        }
    }

    public function setRelations(Rev\DataMapper\AbstractMapper $Mapper, $Driver)
    {
        if (count($Mapper->relations) > 0) {
            foreach ($Mapper->relations as $module => $fields) {
                $this->create($module, $Driver);
        	}
        }
    }
}
