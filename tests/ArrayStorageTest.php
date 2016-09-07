<?php

use RNGR\Cache\ArrayStorage;

class ArrayStorageTest extends PHPUnit_Framework_TestCase
{
    public function testStorage()
    {
        $storage = new ArrayStorage();

        $storage->put('name', 'John', 0);
        $this->assertSame('John', $storage->read('name'));

        $storage->delete('name');
        $this->assertNull($storage->read('name'));

        $storage->put('name', 'Samuel', 0);
        $this->assertSame('Samuel', $storage->read('name'));

        $storage->flush();
        $this->assertNull($storage->read('name'));

        $this->assertSame(1, $storage->increment('count'));
        $this->assertSame(2, $storage->increment('count'));
        $this->assertSame(1, $storage->decrement('count'));
        $this->assertSame(0, $storage->decrement('count'));

        $this->assertSame(-1, $storage->decrement('amount'));
        $this->assertSame(-2, $storage->decrement('amount'));

        $this->assertSame('', $storage->getPrefix());
    }
}
