## Laravel Informix Database Package
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/123393309/shield?branch=master)](https://styleci.io/repos/123393309)
[![Total Downloads](https://img.shields.io/packagist/dt/byte5digital/laravel-ifx.svg?style=flat-square)](https://packagist.org/packages/byte5digital/laravel-harvest)

Laravel-ifx is an Informix Database Driver package for [Laravel Framework](http://laravel.com/) - thanks @taylorotwell. Laravel-ifx is an extension of [Illuminate/Database](https://github.com/illuminate/database) that uses either the PDO extension wrapped into the PDO namespace.

## Install

`composer require byte5digital/laravel-ifx`

Publish config file:
```terminal
$ php artisan vendor:publish --provider="Byte5\LaravelInformix\InformixDBServiceProvider`
```

## Usage
Go to `config/informix.php` and change your settings as you like. Remember to store sensitive data only in `.env` file!

Configs:
```php
return [
    'informix' => [
        'driver'    => 'informix',
        'host'      => env('DB_IFX_HOST', 'localhost'),
        'database'  => env('DB_IFX_DATABASE', 'forge'),
        'username'  => env('DB_IFX_USERNAME', 'forge'),
        'password'  => env('DB_IFX_PASSWORD', ''),
        'service'  => env('DB_IFX_SERVICE', '11143'),
        'server'  => env('DB_IFX_SERVER', ''),
        'db_locale'   => 'en_US.819',
        'client_locale' => 'en_US.819',
        'db_encoding'   => 'GBK',
        'initSqls' => false,
        'client_encoding' => 'UTF-8',
        'prefix'    => ''
    ],
];
```


## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security-related issues, please email mwege@byte5.de instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.