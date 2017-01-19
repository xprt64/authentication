<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace tests\unit\Gica\Authentication;


use Gica\Authentication\AuthenticatedIdentityDefaultService;
use Gica\Types\Guid;

class AuthenticatedIdentityDefaultServiceTest extends \PHPUnit_Framework_TestCase
{

    public function test_authenticate()
    {
        $authenticator = new AuthenticatedIdentityDefaultService();

        $this->assertFalse($authenticator->isAuthenticated());//not before authentication
        $this->assertNull($authenticator->getAuthenticatedIdentityId());//not before authentication

        $authenticatedIdentityId = Guid::generate();

        $authenticator->setAuthenticatedIdentityId($authenticatedIdentityId);

        $this->assertTrue($authenticator->isAuthenticated());
        $this->assertEquals((string)$authenticatedIdentityId, (string)$authenticator->getAuthenticatedIdentityId());
    }
}