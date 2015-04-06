<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Configure
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class Configure
{

    public static $Config;
    private static $filePath;

    public function __construct()
    {
        self::$filePath = SITE . DIRECTORY_SEPARATOR . 'app.json';
        $this->get();
    }

    public function update()
    {
        if (file_exists(self::$filePath)) {
            $handle = fopen(self::$filePath, 'w');
            fwrite($handle, json_encode(self::$Config, JSON_PRETTY_PRINT));
            fclose($handle);
        }
    }

    public function get()
    {
        if (file_exists(self::$filePath)) {
            $handle = fopen(self::$filePath, 'rb');
            self::$Config = json_decode(fread($handle, filesize(self::$filePath)));
            fclose($handle);

            return self::$Config;
        }

        trigger_error('Could not find app.json in ' . self::$filePath, E_USER_ERROR);
    }
}
