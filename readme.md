# Cronlog

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Allows you to log cron jobs to where *you* want it.

## Installation

Via Composer

``` bash
composer require jeroen-g/cronlog
```

## Usage

In app/Console/Kernel.php is where you usually define your scheduled tasks, which are executed when your configured `schedule:run` cron job is running.
To log the output of every scheduled task, append the `cronlog()` function to the command call.

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('inspire')->everyMinute()->cronlog();
}
```

By default, the output is stored using Laravel's [filesystem](https://laravel.com/docs/filesystem)'s `local` disk.
This can easily be swapped by either publishing and editing the configuration for this package or passing the disk name as a parameter to the function call.

```bash
php artisan vendor:publish --tag=cronlog.config
```

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('inspire')->everyMinute()->cronlog('s3');
}
```

The latter option allows you to have different locations for each scheduled task!

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
vendor/bin/phpunit
```

## Contributing

Please see [contributing.md](contributing.md) for details.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Jeroen][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jeroen-g/cronlog.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jeroen-g/cronlog.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jeroen-g/cronlog/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/224276585/shield

[link-packagist]: https://packagist.org/packages/jeroen-g/cronlog
[link-downloads]: https://packagist.org/packages/jeroen-g/cronlog
[link-travis]: https://travis-ci.org/jeroen-g/cronlog
[link-styleci]: https://styleci.io/repos/224276585
[link-author]: https://github.com/jeroen-g
[link-contributors]: ../../contributors
