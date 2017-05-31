<?php


namespace Gica\Authentication\Identity\Persistence;


interface TokenBasedPersistence
{
    public function createToken(string $userId, int $ttl, string $serverName = '');
}