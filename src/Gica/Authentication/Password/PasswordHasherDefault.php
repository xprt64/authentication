<?php
/******************************************************************************
 * Copyright (c) 2017 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication\Password;


use Gica\Authentication\Password;

class PasswordHasherDefault implements Password\PasswordHasher
{
    /**
     * @var int
     * @see self::findBestCost
     */
    protected $cost = 11;
    /**
     * @var int
     */
    protected $algorithm = \PASSWORD_DEFAULT;

    public function hashPassword($password)
    {
        return password_hash($password, $this->getAlgorithm(), [
            'cost' => $this->getCost(),
        ]);
    }

    /**
     * @return int
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * @param mixed $algorithm
     * @return static
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     * @return static
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function passwordNeedsRehash($hash, array $options = [])
    {
        $options['cost'] = $this->getCost();

        return password_needs_rehash($hash, $this->getAlgorithm(), $options);
    }

    public function findBestCost($timeTarget = 0.05, $cost = 8)
    {
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", $this->getAlgorithm(), ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        return $cost;
    }
}