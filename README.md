# StatsCollector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Just a small Laravel5 wrapper over Domnikl\Statsd to send data to StatsD/Graphite really easily.

## Install

Via Composer

``` bash
$ composer require jhmilan/StatsCollector
```

## Setup

Add the service provider to your config.app.php
``` bash
Jhmilan\StatsCollector\ServiceProvider::class,
```

Add the facade to your config.app.php
``` bash
'StatsCollector' => Jhmilan\StatsCollector\Facades\StatsCollector::class,
```

Publish the config file (a new config/statscollector.php file will be created, populate your .env as per the variables in the file)
``` bash
php artisan vendor:publish --provider="Jhmilan\StatsCollector\StatsCollectorServiceProvider"
```

## Usage

Send timers, countes, etc just calling a method! (see /src/Services/StatsD.php to figure out which methods are available)

``` php
echo StatsCollecor::time('foo.bar', 300);
...
```

Add this middleware to your App Middleware to auto collect (config based), request time, request memory usage and request DB operations

``` bash
Jhmilan\StatsCollector\Http\Middleware\CollectorMiddleware
```

## To-do

This package is still WIP, no time for tests or good docs yet! sorry

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jhmilan@gmail.com instead of using the issue tracker.

## Credits

- [Jose H. Milán][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jhmilan/StatsCollector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jhmilan/StatsCollector/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/jhmilan/StatsCollector.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/jhmilan/StatsCollector.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jhmilan/StatsCollector.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jhmilan/StatsCollector
[link-travis]: https://travis-ci.org/jhmilan/StatsCollector
[link-scrutinizer]: https://scrutinizer-ci.com/g/jhmilan/StatsCollector/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/jhmilan/StatsCollector
[link-downloads]: https://packagist.org/packages/jhmilan/StatsCollector
[link-author]: https://github.com/jhmilan
[link-contributors]: ../../contributors
