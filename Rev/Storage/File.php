<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Storage \ File
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev\Storage;

use Rev;

class File implements \SessionHandlerInterface
{

    private $dir;
    private $ext;
    protected $ttl;

    public function __construct($ttl)
    {
        $this->ttl = $ttl;
        $this->dir = SITE . DS . Rev\Configure::$Config->cache->file->dir . DS;
        $this->ext = Rev\Configure::$Config->cache->file->ext;

        if (!is_writeable($this->dir)) {
            trigger_error($this->dir . ' is not writeable.');
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
        $filename = $this->dir . $id . $this->ext;
        if (!file_exists($filename)) {
            return false;
        }

        $file = file($filename);
        $expires  = explode(':', $file[1]);
        $expires  = (int) $expires[2];
        $file     = implode("\n", array_slice($file, 4));

        $fileExpires = filemtime($filename) + $expires;

        if (time() >= $fileExpires) {
            $this->destroy($id);
            return false;
        }

        return (string) $file;
    }

    public function write($id, $data)
    {
        $contents   = arrray();
        $contents[] = '# EXPIRES:' . $this->ttl;
        $contents[] = '# CHECKSUM:' . md5($data);
        $contents[] = serialize($data);
        $contents   = implode("\n", $data);

        $fp = fopen($this->dir . $id . $this->ext, 'w');

        if (flock($fp, LOCK_EX|LOCK_NB)) {
            fwrite($fp, $contents);
            flock($fp, LOCK_UN);
            fclose($fp);
        } else {
            fclose($fp);
            return false;
        }

        return true;
    }

    public function destroy($id)
    {
        $filename = $this->dir . $id . $this->ext;
        if (!file_exists($filename)) {
            return false;
        }

        return unlink($filename, 'w');
    }

    public function gc($lifetime)
    {
        $di = new DirectoryIterator($this->dir);

        foreach ($di as $fileInfo) {
            if ($fileInfo->isFile()) {
                unlink($fileInfo->getPathname());
            }
        }

        return true;
    }
}
