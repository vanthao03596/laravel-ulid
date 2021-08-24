# Laravel package for ULID (Universally Unique Lexicographically Sortable Identifier)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vanthao03596/laravel-ulid.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ulid)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ulid/run-tests?label=tests)](https://github.com/vanthao03596/laravel-ulid/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ulid/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vanthao03596/laravel-ulid/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vanthao03596/laravel-ulid.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ulid)

## Installation

You can install the package via composer:

```bash
composer require vanthao03596/laravel-ulid
```

## Usage

Generate uld from Str support class

```php
// Default ulid generator with the current timestamp & lowercase string
Str::ulid(); // 01FDRXQ57VR4K4RASPT9NPAQC0
// Default ulid generator with the current timestamp & uppercase string
Str::ulid(false); // 01fdrxpmg9njp20z3km461fgax
// Default ulid generator with the given datetime & uppercase string
Str::ulid(false, Carbon::now()->subHour()) // 01FDRTD2K8Z664S24X606N14KD
```

Simply declare a ulid column type in your migration files.

```php
Schema::create('foos', function (Blueprint $table) {
    $table->ulid('id')->primary(); // adds primary ulid column 
    $table->foreignUlid('user_id')->constrained()->cascadeOnDelete(); // adds ulid foreignkey
    $table->ulidMorphs('taggable'); // adds ulid morphs
    $table->nullableUlidMorphs('likeable'); // adds nullable ulid morphs
});
```

Auto generate ulid column in your model

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vanthao03596\LaravelUlid\GeneratesUlid;

class User extends Model
{
    use GeneratesUlid;
}

```

Default column is `ulid`. If you wish to use a custom column name, for example if you want your primary `custom_column` column to be a `ULID`, you can define a `ulidColumn` method in your model.

```php
class User extends Model
{
    public function ulidColumn(): string
    {
        return 'custom_column';
    }
}
```

You can have multiple ULID columns in each table by specifying an array in the `ulidColumns` method. 

```php
class User extends Model
{
    public function ulidColumns(): array
    {
        return ['ulid', 'custom_column'];
    }
}
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
