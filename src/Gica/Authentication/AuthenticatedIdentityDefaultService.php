<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication;


use Gica\Types\Guid;

class AuthenticatedIdentityDefaultService
    implements \Gica\Authentication\AuthenticatedIdentityService
{
    /**
     * @var Guid|null
     */
    protected $authenticatedIdentityId;

    public function isAuthenticated()
    {
        return !!$this->authenticatedIdentityId;
    }

    public function getAuthenticatedIdentityId()
    {
        if (!$this->isAuthenticated())
            return null;

        return $this->authenticatedIdentityId;
    }

    public function unAuthenticate()
    {
        $this->authenticatedIdentityId = null;
    }

    public function setAuthenticatedIdentityId(Guid $authenticatedIdentityId)
    {
        $this->authenticatedIdentityId = $authenticatedIdentityId;
    }
}