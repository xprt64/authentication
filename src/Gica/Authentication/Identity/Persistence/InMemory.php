<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Identity\Persistence;


class InMemory implements \Gica\Authentication\Identity\Persistence
{
    static $storage;
    static $storageAdditionalData;

    #[\Override]
    public function save($identityId, array $additionalData = [])
    {
        self::$storage = $identityId;
        self::$storageAdditionalData = $additionalData;
    }

    #[\Override]
    public function load()
    {
        return self::$storage;
    }

    #[\Override]
    public function clear()
    {
        self::$storage = null;
    }

    /**
     * @return \stdClass
     */
    #[\Override]
    public function loadAdditionalData()
    {
        return self::$storageAdditionalData;
    }
}