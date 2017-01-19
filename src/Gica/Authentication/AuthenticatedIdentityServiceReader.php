<?php
/******************************************************************************
 * Copyright (c) 2017 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication;

use Gica\Types\Guid;

interface AuthenticatedIdentityServiceReader
{
    /**
     * @return Guid|null
     */
    public function getAuthenticatedIdentityId();
}