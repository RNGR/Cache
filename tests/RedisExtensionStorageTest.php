<?php

use RNGR\Cache\RedisExtensionStorage;

class RedisExtensionStorageTest extends PHPUnit_Framework_TestCase
{
    public function testStorage()
    {
        $redis = $this->getMockBuilder('Redis')
            ->setMethods(array('get', 'set', 'flushDB', 'delete', 'decrBy', 'incrBy'))
            ->getMock();

        $redis->expects($this->at(0))
            ->method('get')
            ->with($this->equalTo('prefix:age'))
            ->will($this->returnValue(null));

        $redis->expects($this->at(1))
            ->method('get')
            ->with($this->equalTo('prefix:name'))
            ->will($this->returnValue(serialize('joseph')));

        $redis->expects($this->at(2))
            ->method('get')
            ->with($this->equalTo('prefix:age'))
            ->will($this->returnValue(22));

        $redis->expects($this->at(3))
            ->method('get')
            ->with($this->equalTo('prefix:city'))
            ->will($this->returnValue(serialize('miami')));

        $redis->expects($this->once())
            ->method('set')
            ->with($this->equalTo('prefix:city'), $this->equalTo(serialize('miami')), $this->equalTo(0));

        $redis->expects($this->once())
            ->method('incrBy')
            ->with($this->equalTo('age'));

        $redis->expects($this->once())
            ->method('decrBy')
            ->with($this->equalTo('age'));

        $redis->expects($this->once())
            ->method('delete')
            ->with($this->equalTo('prefix:city'));

        $redis->expects($this->once())
            ->method('flushDB');

        $storage = new RedisExtensionStorage($redis, 'prefix');

        $this->assertSame(null, $storage->read('age'));
        $this->assertSame('joseph', $storage->read('name'));
        $this->assertSame('prefix:', $storage->getPrefix());

        $this->assertSame(22, $storage->read('age'));
        $this->assertSame('miami', $storage->read('city'));

        $storage->put('city', 'miami', 0);

        $storage->increment('age');
        $storage->decrement('age');

        $storage->delete('city');
        $storage->flush();
    }
}