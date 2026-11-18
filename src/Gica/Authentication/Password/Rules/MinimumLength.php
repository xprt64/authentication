<?php
////////////////////////////////////////////////////////////////////////////////
// Copyright (c) 2016 Constantin Galbenu <gica.galbenu@gmail.com>              /
////////////////////////////////////////////////////////////////////////////////

namespace Gica\Authentication\Password\Rules;


class MinimumLength implements \Gica\Authentication\Password\Rule
{
    /**
     * @param int $minimumLength
     * @param string $messageTemplate
     */
    public function __construct(private $minimumLength, private $messageTemplate = "Parola trebuie sa fie de minim {minimumLength} caractere")
    {
    }

    public function validate($password)
    {
        if(strlen($password) < $this->minimumLength)
            throw new \Exception($this->getDescription());
    }

    function getDescription()
    {
        return (string)str_replace('{minimumLength}', $this->minimumLength, $this->messageTemplate);
    }
}