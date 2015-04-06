<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Storage \ Eaccelerator
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Storage;

class Eaccelerator implements \SessionHandlerInterface
{

    protected $ttl;

    public function __construct($ttl)
    {
        $this->ttl = $ttl;
    }

    public function open($savePath, $sessionName)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        return (string) eaccelerator_get($id);
    }

    public function write($id, $data)
    {
        return eaccelerator_put($id, $data, $this->ttl);
    }

    public function destroy($id)
    {
        return eaccelerator_rm($id);
    }

    public function gc($lifetime)
    {
        eaccelerator_gc();
        return true;
    }
}
