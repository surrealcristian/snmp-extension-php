# SNMP Extension

Wrapper over the SNMP extension.


## Install

Via Composer

``` bash
$ composer require surrealcristian/snmp-extension
```


## Requirements

- PHP 5.4+
- SNMP extension


## Usage


### `SimpleSnmpV2c`

#### `setup`

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use SurrealCristian\SnmpExtension\Builder;
use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;
use SurrealCristian\SimpleSnmp\Exception\TimeoutException;

$host = '127.0.0.1';
$community = 'private';
$timeout = 1000000; // microseconds
$retries = 3;

$snmp = (new Builder)->getSimpleSnmpV2c();
```

#### `get`

```php
<?php

try {
    $oid = '1.2.3.4.5.0';

    $res = $snmp->get($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SimpleSnmpException $e) {
    // handle exception
}

// array (
//   'oid' => '1.2.3.4.5.0',
//   'type' => 'STRING',
//   'value' => '"foo 0"',
// )
```

#### `getNext`

```php
<?php

try {
    $oid = '1.2.3.4.5.0';

    $res = $snmp->getNext($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SimpleSnmpException $e) {
    // handle exception
}

// array (
//   'oid' => null,
//   'type' => 'STRING',
//   'value' => '"foo 1"',
// )
```

#### `walk`

```php
<?php

try {
    $oid = '1.2.3.4.5';

    $res = $snmp->walk($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SimpleSnmpException $e) {
    // handle exception
}

// array (
//   0 => array (
//     'oid' => '1.2.3.4.5.0',
//     'type' => 'STRING',
//     'value' => '"foo 0"',
//   ),
//   1 => array (
//     'oid' => '1.2.3.4.5.1',
//     'type' => 'STRING',
//     'value' => '"foo 1"',
//   ),
// )
```

#### `bulkWalk`

```php
<?php

try {
    $oid = '1.2.3.4.5';

    $res = $snmp->bulkWalk($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SimpleSnmpException $e) {
    // handle exception
}

// array (
//   0 => array (
//     'oid' => '1.2.3.4.5.0',
//     'type' => 'STRING',
//     'value' => '"foo 0"',
//   ),
//   1 => array (
//     'oid' => '1.2.3.4.5.1',
//     'type' => 'STRING',
//     'value' => '"foo 1"',
//   ),
// )
```

#### `set`

```php
<?php

try {
    $oid = '1.2.3.4.6.0';

    $snmp->set($host, $community, $oid, 's', 'test', $timeout, $retries);
} catch (TimeoutException $e) {
    // handle exception
} catch (SimpleSnmpException $e) {
    // handle exception
}
```


## API

```
namespace SurrealCristian\SnmpExtension


class Builder

public SimpleSnmpV2c getSimpleSnmpV2c ()


class SimpleSnmpV2c implements SnmpV2cInterface

public array get ( string $host, string $community, string $oid, int $timeout, int $retries )

public array getNext ( string $host, string $community, string $oid, int $timeout, int $retries )

public array walk ( string $host, string $community, string $oid, int $timeout, int $retries )

public array bulkWalk ( string $host, string $community, string $oid, int $timeout, int $retries )

public set ( string $host, string $community, string $oid, string $type, string $value, int $timeout, int $retries )
```


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information


## Testing

```bash
$ cd /path/to/repo
$ phpunit
```


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
