# Laravel package for ULID (Universally Unique Lexicographically Sortable Identifier)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vanthao03596/laravel-ulid.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ulid)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ulid/run-tests?label=tests)](https://github.com/vanthao03596/laravel-ulid/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ulid/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vanthao03596/laravel-ulid/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vanthao03596/laravel-ulid.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ulid)

---
This repo can be used to scaffold a Laravel package. Follow these steps to get started:

1. Press the "Use template" button at the top of this repo to create a new repo with the contents of this laravel-ulid
2. Run "./configure-laravel-ulid.sh" to run a script that will replace all placeholders throughout all the files
3. Remove this block of text.
4. Have fun creating your package.
---

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require vanthao03596/laravel-ulid
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Vanthao03596\LaravelUlid\LaravelUlidServiceProvider" --tag="laravel-ulid-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Vanthao03596\LaravelUlid\LaravelUlidServiceProvider" --tag="laravel-ulid-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-ulid = new Vanthao03596\LaravelUlid();
echo $laravel-ulid->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [phamthao](https://github.com/vanthao03596)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
