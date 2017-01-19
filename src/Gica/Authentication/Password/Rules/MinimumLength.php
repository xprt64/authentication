<?php
////////////////////////////////////////////////////////////////////////////////
// Copyright (c) 2016 Constantin Galbenu <gica.galbenu@gmail.com>              /
////////////////////////////////////////////////////////////////////////////////

namespace Gica\Authentication\Password\Rules;


class MinimumLength implements \Gica\Authentication\Password\Rule
{
    /** @var int */
    private $minimumLength;

    /** @var string */
    private $messageTemplate;

    public function __construct($minimumLength, $messageTemplate = "Parola trebuie sa fie de minim {minimumLength} caractere")
    {
        $this->minimumLength = $minimumLength;
        $this->messageTemplate = $messageTemplate;
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