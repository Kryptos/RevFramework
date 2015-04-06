<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ DataMapper \ Mapper
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\DataMapper;

abstract class AbstractMapper
{
    public function save(Entity $Entity)
    {
        (is_null($Entity->id ? $this->create($Entity) : $this->update($Entity)));
    }

    abstract protected function create(AbstractEntity $Entity);
    abstract protected function read(AbstractEntity $Entity);
    abstract protected function update(AbstractEntity $Entity);
    abstract protected function delete(AbstractEntity $Entity);
}
