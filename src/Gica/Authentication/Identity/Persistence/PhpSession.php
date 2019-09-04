<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Identity\Persistence;


use Gica\Authentication\Identity\Persistence;

class PhpSession implements Persistence
{
    protected $started = false;
    protected $sessionKeyName;

    public function __construct($sessionKeyName = 'authenticatedIdentity')
    {
        $this->sessionKeyName = $sessionKeyName;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setSessionName($name)
    {
        session_name($name);
        return $this;
    }

    public function save($identityId, array $additionalData = [])
    {
        $this->sessionStart();
        $_SESSION[$this->getSessionKeyName()] = $identityId;
        $_SESSION[$this->getSessionKeyName() . '_additionalData'] = $additionalData;
        session_write_close();
    }

    /**
     * @return mixed
     */
    public function load()
    {
        $this->sessionStart();
        return $_SESSION[$this->getSessionKeyName()];
    }

    public function clear()
    {
        $this->sessionStart();
        unset($_SESSION[$this->getSessionKeyName()]);
    }

    protected function sessionStart()
    {
        if(!$this->started && PHP_SAPI !== 'cli' && !headers_sent()) session_start();
        return $this;
    }

    public function setSessionHandler(\SessionHandlerInterface $sessionHandler)
    {
        session_set_save_handler($sessionHandler, true);
    }

    /**
     * @return string
     */
    protected function getSessionKeyName()
    {
        return $this->sessionKeyName;
    }

    public function getSessionId()
    {
        return session_id();
    }

    /**
     * @return \stdClass
     */
    public function loadAdditionalData()
    {
        $this->sessionStart();
        return $_SESSION[$this->getSessionKeyName() . '_additionalData'];
    }
}