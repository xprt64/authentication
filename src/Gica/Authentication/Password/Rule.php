<?php
////////////////////////////////////////////////////////////////////////////////
// Copyright (c) 2016 Constantin Galbenu <gica.galbenu@gmail.com>              /
////////////////////////////////////////////////////////////////////////////////

namespace Gica\Authentication\Password;

interface Rule
{
    /**
     * @param string $password
     * @throws \Exception
     */
    public function validate($password);

    /**
     * @return string
     */
    function getDescription();
}