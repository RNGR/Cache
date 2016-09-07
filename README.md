# Cache
Simple Cache library

[![Travis](https://img.shields.io/travis/RNGR/Cache.svg?maxAge=2592000&style=flat-square)]()
[![Scrutinizer](https://img.shields.io/scrutinizer/g/rngr/cache.svg?maxAge=2592000&style=flat-square)]()
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/rngr/cache.svg?maxAge=2592000&style=flat-square)]()
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Usage

```php
$redis = new \Redis();
$redis->connect('127.0.0.1', 6379);

$storage = new RedisExtensionStorage($redis, 'prefix');
$repository = new Repository($storage);

// set value
$repository->set('key', 'value');

// read value
$value = $repository->read('key');

// read and delete value
$value = $repository->readAndDelete('key');

// check if value exists
$exists = $repository->has('key');
```
