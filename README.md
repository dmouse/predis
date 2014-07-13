Predis module
=============

This module provides a service connection to Redis using Predis library, this module only provides a service to be used in other modules.

### How to install
This module need predis in the root composer.json
```bash 
$ composer require predis/predis:~0.8.0
```

### How to use
```yaml
# my_module.services.yml
services:
  my_module.connection:
    class: Drupal\my_module\Connection
    arguments: ['@predis.connection']
```

```php
use Drupal\predis\RedisConnectionInterface;
// ...
public function __construct(RedisConnectionInterface $redis) {
  $this->redis = $redis->getConnection();
}
// ...
```

#### Related modules:
* https://www.drupal.org/project/redis
* https://www.drupal.org/project/redis_queue