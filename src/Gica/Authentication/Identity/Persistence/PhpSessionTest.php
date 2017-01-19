<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace tests\unit\Gica\Authentication\Identity\Persistence;

class PhpSessionTest extends \PHPUnit_Framework_TestCase
{

    public function test_session()
    {
        $session = new \Gica\Authentication\Identity\Persistence\PhpSession();

        $session->setSessionHandler(new MySessionHandler());

        $session->setSessionName('name');

        $session->save(new MyUser(1));

        /** @var MyUser $user */
        $user = $session->load();

        $this->assertInstanceOf(MyUser::class, $user);

        $this->assertSame(1, $user->getId());

        $session->clear();

        $this->assertNull($session->load());
    }
}

class MySessionHandler implements \SessionHandlerInterface
{
    private $savePath;
    private $data;

    public function open($savePath, $sessionName)
    {
        $this->savePath = $savePath;
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        return (string)$this->data;
    }

    public function write($id, $data)
    {
        $this->data = $data;
        return true;
    }

    public function destroy($id)
    {
        unset($this->data);

        return true;
    }

    public function gc($maxlifetime)
    {
        return true;
    }
}

class MyUser
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}