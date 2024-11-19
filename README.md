# Short description of the package

This package provides realization of an observer for a system of events.

## Installation

You can install the package via composer:

```bash
composer require silencenjoyer/observer
```

## Usage

```php
<?php

use Silencenjoyer\Observer\EventDispatcher;
use Silencenjoyer\Observer\Tests\EventSubscribers\TestEventSubscriber;

$eventDispatcher = new EventDispatcher();
$eventDispatcher
    ->attachSubscriber(new TestEventSubscriber())
    ->attachSubscriber(new SomeEventSubscriber())
    ->attachSubscriber(new OneMoreEventSubsriber())
;

$eventDispatcher->dispatch(new SomeEvent());
```

### Testing

```bash
composer test  
composer test-coverage  
docker-compose -f tests/docker/docker-compose.test.yml up
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email an_gebrich@outlook.com instead of using the issue tracker.

## Credits

-   [Andrew Gebrich](https://github.com/silencenjoyer)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
