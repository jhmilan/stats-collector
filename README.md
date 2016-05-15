# StatsCollector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require jhmilan/StatsCollector
```

``` bash
Jhmilan\StatsCollector\ServiceProvider::class,
```

``` bash
'StatsCollector' => Jhmilan\StatsCollector\Facades\StatsCollector::class,
```

## Usage

``` php
echo StatsCollecor::time('foo.bar', 300);
...
```

``` bash
php artisan vendor:publish --provider="Jhmilan\StatsCollector\StatsCollectorServiceProvider"
```

Add this middleware to your App Middleware to auto collect (config based), request time, request memory usage and request DB operations

``` bash
Jhmilan\StatsCollector\Http\Middleware\CollectorMiddleware
```

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
