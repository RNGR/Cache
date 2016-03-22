<?php

namespace RNGR\Cache;


class RedisExtensionStorage implements StorageInterface
{
    /**
     * Redis Object
     * @var \Redis
     */
    protected $redis;

    /**
     * Cache key prefix
     * @var string
     */
    protected $prefix = '';

    /**
     * RedisExtensionStorage constructor.
     */
    public function __construct()
    {
        $this->redis = new \Redis;
    }

    /**
     * Connect
     */
    public function connect()
    {
        call_user_func_array($this->redis, func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function read($key)
    {
        $value = $this->redis->get($key);
        if ($value) {
            return is_numeric($value) ? $value : unserialize($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value, $seconds)
    {
        $this->redis->set($key, is_numeric($value) ? $value : serialize($value), $seconds);
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        $this->redis->delete($key);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        $this->redis->flushDB();
    }

    /**
     * @inheritDoc
     */
    public function getPrefix()
    {
        return '';
    }

    public function setPrefix($prefix)
    {
        $this->prefix = !empty($prefix) ? $prefix.':' : '';
    }
}
