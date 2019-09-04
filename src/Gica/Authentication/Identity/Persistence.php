<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Identity;

interface Persistence
{
    public function save($identityId, array $additionalData = []);

    /**
     * @return int
     */
    public function load();

    /**
     * @return \stdClass
     */
    public function loadAdditionalData();

    public function clear();
}