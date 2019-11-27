<?php
/******************************************************************************
 * Copyright (c) 2016 Constantin Galbenu <gica.galbenu@gmail.com>             *
 ******************************************************************************/

namespace Gica\Authentication\Identity\Persistence;


use Firebase\JWT\JWT;
use Gica\Authentication\Identity\Persistence;

class CookieJsonWebToken implements Persistence, TokenBasedPersistence
{
    private $secret;
    private $cookieName;
    private $ttl;
    private $cookieTtl;

    public function __construct($secret, $cookieName = 'jwt', $ttl = 3600000)
    {
        $this->secret = $secret;
        $this->cookieName = $cookieName;
        $this->ttl = $ttl;
        $this->cookieTtl = $ttl;
    }

    public function setTtl(int $ttl)
    {
        $this->ttl = $ttl;
    }

    public function setCookieTtl(int $cookieTtl)
    {
        $this->cookieTtl = $cookieTtl;
    }

    public function createToken(string $userId, int $ttl, array $additionalData = [])
    {

        $tokenId = \base64_encode(\random_bytes(32));
        $issuedAt = \time();
        $notBefore = $issuedAt;             //Adding 10 seconds
        $expire = $notBefore + $ttl;            // Adding xxx seconds

        $additionalData['userId'] = $userId;
        /*
         * Create the token as an array
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => 'localhost',       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => $additionalData,
        ];

        return JWT::encode(
            $data,      //Data to be encoded in the JWT
            $this->secret, // The signing key
            'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
    }

    public function save($identityId, array $additionalData = [])
    {
        $token = $this->createToken((string)$identityId, $this->ttl, $additionalData);

        if (false === setcookie($this->cookieName, $token, $this->cookieTtl ? time() + $this->cookieTtl : 0, '/')) {
            throw new \Exception("could not set cookie {$this->cookieName}");
        }
    }

    public function load()
    {
        $data = $this->loadAdditionalData();
        if ($data) {
            return $data->userId;
        }
        return null;
    }

    public function clear()
    {
        setcookie($this->cookieName, '', time() - 86400, '/');
        unset($_COOKIE[$this->cookieName]);
    }

    /**
     * @return \stdClass|null
     */
    public function loadAdditionalData()
    {
        $jwt = $_COOKIE[$this->cookieName];

        if ($jwt) {
            try {
                $token = JWT::decode($jwt, $this->secret, ['HS512']);
                if ($token->data instanceof \stdClass) {
                    return $token->data;
                }
                return null;
            } catch (\Throwable $e) {
                //throw $e;
            }
        }

        return null;
    }

    public function decodeToken(string $jwt): \stdClass
    {
        return JWT::decode($jwt, $this->secret, ['HS512']);
    }
}