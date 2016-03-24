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
     * @param string $prefix
     */
    public function __construct($prefix = '')
    {
        $this->redis = new \Redis;
        $this->setPrefix($prefix);
    }

    /**
     * Connect
     */
    public function connect()
    {
        return call_user_func_array([$this->redis, 'connect'], func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function read($key)
    {
        $value = $this->redis->get($this->prefix.$key);
        if ($value) {
            return is_numeric($value) ? $value : unserialize($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value, $seconds)
    {
        $this->redis->set($this->prefix.$key, is_numeric($value) ? $value : serialize($value), $seconds);
    }

    /**
     * @inheritdoc
     */
    public function increment($key, $value = 1)
    {
        return $this->redis->incrBy($key, $value);
    }

    /**
     * @inheritdoc
     */
    public function decrement($key, $value = 1)
    {
        return $this->redis->decrBy($key, $value);
    }
    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        $this->redis->delete($this->prefix.$key);

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
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = !empty($prefix) ? $prefix.':' : '';
    }

    /**
     * Pass missing methods to Redis.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->redis, $method], $parameters);
    }
}
