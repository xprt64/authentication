<?php
/******************************************************************************
 * Copyright (c) 2016 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication;


use Gica\Authentication\Identity\RoleReader;

class AuthenticatedIdentityRoles
{

    /**
     * @var \Gica\Authentication\Identity\RoleReader
     */
    protected $roleAdapter;
    /**
     * @var AuthenticatedIdentityDefaultService
     */
    private $authenticatedIdentity;

    public function __construct(
        RoleReader $roleAdapter,
        AuthenticatedIdentityService $authenticatedIdentity)
    {
        $this->roleAdapter = $roleAdapter;
        $this->authenticatedIdentity = $authenticatedIdentity;
    }

    public function hasRole($role)
    {
        if (!$this->authenticatedIdentity->isAuthenticated())
            return false;

        return $this->roleAdapter->hasRole($this->authenticatedIdentity->getAuthenticatedIdentityId(), $role);
    }

    public function getAllPossibleRoles()
    {
        return $this->roleAdapter->getAllPossibleRoles();
    }
}