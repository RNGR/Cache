<?php

namespace RNGR\Cache;

class ArrayStorage implements StorageInterface
{
    /**
     * List of stored values.
     *
     * @var array
     */
    protected $storage = [];

    /**
     * @inheritDoc
     */
    public function read($key)
    {
        if (array_key_exists($key, $this->storage)) {
            return $this->storage[$key];
        }
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value, $seconds)
    {
        $this->storage[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function increment($key, $value = 1)
    {
        return $this->incrementBy($key, $value);
    }

    /**
     * @inheritdoc
     */
    public function decrement($key, $value = 1)
    {
        return $this->incrementBy($key, ($value * -1));
    }

    protected function incrementBy($key, $value = 1)
    {
        if (!array_key_exists($key, $this->storage)) {
            $this->storage[$key] = 0;
        }

        return $this->storage[$key] += $value;
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        unset($this->storage[$key]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        $this->storage = [];
    }

    /**
     * @inheritDoc
     */
    public function getPrefix()
    {
        return '';
    }
}
