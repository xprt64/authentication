<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Identity;

interface Persistence
{
    public function save($identityId);

    /**
     * @return int
     */
    public function load();

    public function clear();
}