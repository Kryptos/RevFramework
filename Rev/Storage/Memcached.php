<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Storage \ Memcached
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Storage;

use Rev;

class Memcached implements \SessionHandlerInterface
{

    private $memcached;
    protected $ttl;

    public function __construct($ttl)
    {
        $this->ttl = $ttl;

        $this->memcached = new Memcached();

        foreach (Rev\Configure::$Config->cache->memcached as $server) {
            $this->memcached->addServer($server[0], $server[1]);
        }
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
        return (string) $this->memcached->get($id);
    }

    public function write($id, $data)
    {
        return $this->memcached->set($id, $data, $this->ttl);
    }

    public function destroy($id)
    {
        return $this->memcached->delete($id);
    }

    public function gc($lifetime)
    {
        return $this->memcached->flush();
    }
}
