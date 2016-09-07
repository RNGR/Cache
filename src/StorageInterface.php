<?php

namespace RNGR\Cache;

interface StorageInterface
{
    /**
     * Read an item from cache by key.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function read($key);

    /**
     * Put a value in cache by key for a given number of minutes.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  int     $seconds
     *
     * @return void
     */
    public function put($key, $value, $seconds);

    /**
     * Increment value of a item
     *
     * @param  string  $key
     * @param int $value
     *
     * @return int incremented value
     */
    public function increment($key, $value);

    /**
     * Decrement value of a item
     *
     * @param  string  $key
     * @param int $value
     *
     * @return int decremented value
     */
    public function decrement($key, $value);

    /**
     * Remove an item from the cache by key.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function delete($key);

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function flush();

    /**
     * Get the cache key prefix.
     *
     * @return string
     */
    public function getPrefix();
}
