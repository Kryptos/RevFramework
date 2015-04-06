<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ DataMapper \ Entity
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\DataMapper;

abstract class AbstractEntity
{
    public function __set($property, $value)
    {
        $this->{$property} = $value;

        if (count($this->relations) > 0) {
            foreach ($this->relations as $entity => $fields) {
                foreach ($fields as $k => $v) {
                    if ($v = $property) {
                        $this->relations[$entity][$k] = $value;
                    }
                }
            }
        }
    }

    public function getRelation($entity)
    {
        return $this->relations[$entity];
    }
}
