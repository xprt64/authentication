<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace Gica\Authentication\Password;


interface PasswordHasher
{
    public function hashPassword($password);

    public function verifyPassword($password, $hash);

    public function passwordNeedsRehash($hash, array $options = []);
}