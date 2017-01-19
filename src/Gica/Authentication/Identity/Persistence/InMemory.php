<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Identity\Persistence;


class InMemory implements \Gica\Authentication\Identity\Persistence
{
    /**
     * @var \Gica\Interfaces\Entity
     */
    static $storage;

    public function save($identityId)
    {
        self::$storage = $identityId;
    }

    /**
     * @return \Gica\Interfaces\Entity
     */
    public function load()
    {
        return self::$storage;
    }

    public function clear()
    {
        self::$storage = null;
    }
}