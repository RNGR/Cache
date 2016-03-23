# Cache
Simple Cache library

## Usage

```php
$storage = new RedisExtensionStorage('prefix');
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