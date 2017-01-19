<?php
/******************************************************************************
 * Copyright (c) 2017 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication\Identity;

use Gica\Types\Guid;

interface RoleReader
{
    public function hasRole(Guid $identityId, $role);

    public function getAllPossibleRoles();
}