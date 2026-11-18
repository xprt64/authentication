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

    public function __construct(protected $sessionKeyName = 'authenticatedIdentity')
    {
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

    #[\Override]
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
    #[\Override]
    public function load()
    {
        $this->sessionStart();
        return $_SESSION[$this->getSessionKeyName()];
    }

    #[\Override]
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
    #[\Override]
    public function loadAdditionalData()
    {
        $this->sessionStart();
        return $_SESSION[$this->getSessionKeyName() . '_additionalData'];
    }
}