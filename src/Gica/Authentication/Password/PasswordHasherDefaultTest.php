<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace tests\unit\Gica\Authentication;


class PasswordHasherDefaultTest extends \PHPUnit_Framework_TestCase
{

    public function test_hasher()
    {
        $hasher = new \Gica\Authentication\Password\PasswordHasherDefault();

        $hasher->setCost(10);
        $hasher->setAlgorithm(\PASSWORD_DEFAULT);

        $hashedPassword = $hasher->hashPassword('1234');

        $this->assertTrue($hasher->verifyPassword('1234', $hashedPassword));

        $this->assertFalse($hasher->verifyPassword('9876', $hashedPassword));
        $this->assertFalse($hasher->passwordNeedsRehash($hashedPassword));

        $hasher->setCost(11);//cost has changed
        $this->assertTrue($hasher->passwordNeedsRehash($hashedPassword));

        $this->assertInternalType('integer', $hasher->findBestCost());
    }
}
