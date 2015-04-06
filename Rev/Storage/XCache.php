<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Storage \ XCache
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Storage;

class XCache implements \SessionHandlerInterface
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
        if(!xcache_isset($id)) {
            return false;
        }

        return (string) xcache_get($id);
    }

    public function write($id, $data)
    {
        return xcache_set($id, $data, $this->ttl);
    }

    public function destroy($id)
    {
         if(!xcache_isset($id)) {
            return false;
        }

        return xcache_unset($id);
    }

    public function gc($lifetime)
    {
        return true;
    }
}
