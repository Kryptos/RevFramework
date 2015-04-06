<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Storage \ APC
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Storage;

class APC implements \SessionHandlerInterface
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
        if (!apc_exists($id)) {
            return false;
        }

        return (string) apc_fetch($id);
    }

    public function write($id, $data)
    {
        return apc_store($id, $data, $this->ttl);
    }

    public function destroy($id)
    {
        if (!apc_exists($id)) {
            return false;
        }

        return apc_delete($id);
    }

    public function gc($lifetime)
    {
        return apc_clear_cache('user');
    }
}
