<?php
/**
 * -----------------------------------------------------------------------------
 * Rev Framework \ Rev \ Session
 * -----------------------------------------------------------------------------
 * @author          Kryptos (http://twitter.com/_Kryptos)
 * @copyright      (c) 2015 Kryptos (http://github.com/Kryptos)
 * @license         MIT
 * -----------------------------------------------------------------------------
 */

namespace Rev;

class Session
{
    public function __construct()
    {
        $this->initialize();
    }

    private function initialize()
    {
        if (Configure::$Config->session->enabled == true) {
            $Session = 'Rev\\Storage\\' . Configure::$Config->session->handler;
            session_set_save_handler(new $Session(Configure::$Config->session->gc_maxlifetime), true);

            register_shutdown_function('session_write_close');
        }

        session_start();
    }
}
