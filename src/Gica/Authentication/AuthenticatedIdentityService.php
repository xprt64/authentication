<?php
/******************************************************************************
 * Copyright (c) 2017 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication;

use Gica\Types\Guid;

interface AuthenticatedIdentityService extends AuthenticatedIdentityServiceReader
{
     /**
     * @return boolean
     */
    public function isAuthenticated();

    public function unAuthenticate();

    public function setAuthenticatedIdentityId(Guid $authenticatedIdentityId);
}