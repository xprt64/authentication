<?php
/**
 * @copyright  Copyright (c) Galbenu xprt64@gmail.com
 * All rights reserved.
 */

namespace tests\unit\Gica\Authentication\Identity\Persistence;

class InMemoryTest extends \PHPUnit_Framework_TestCase
{

    public function test_session()
    {
        $session = new \Gica\Authentication\Identity\Persistence\InMemory();

        $session->save(2);

        $loadedUserId = $session->load();
        $this->assertEquals(2, $loadedUserId);

        $session->clear();

        $this->assertNull($session->load());
    }
}