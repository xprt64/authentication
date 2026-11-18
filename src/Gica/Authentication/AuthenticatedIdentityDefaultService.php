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

    #[\Override]
    public function isAuthenticated()
    {
        return !!$this->authenticatedIdentityId;
    }

    #[\Override]
    public function getAuthenticatedIdentityId()
    {
        if (!$this->isAuthenticated())
            return null;

        return $this->authenticatedIdentityId;
    }

    #[\Override]
    public function unAuthenticate()
    {
        $this->authenticatedIdentityId = null;
    }

    #[\Override]
    public function setAuthenticatedIdentityId(Guid $authenticatedIdentityId)
    {
        $this->authenticatedIdentityId = $authenticatedIdentityId;
    }
}