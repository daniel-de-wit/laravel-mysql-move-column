# Laravel MySQL Move Column

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Tests](https://github.com/daniel-de-wit/laravel-mysql-move-column/actions/workflows/tests.yml/badge.svg)](https://github.com/daniel-de-wit/laravel-mysql-move-column/actions/workflows/tests.yml)
[![Coverage Status](https://coveralls.io/repos/github/daniel-de-wit/laravel-mysql-move-column/badge.svg?branch=main&kill_cache=1)](https://coveralls.io/github/daniel-de-wit/laravel-mysql-move-column?branch=main)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/daniel-de-wit/laravel-mysql-move-column.svg?style=flat-square)](https://packagist.org/packages/daniel-de-wit/laravel-mysql-move-column)
[![Total Downloads](https://img.shields.io/packagist/dt/daniel-de-wit/laravel-mysql-move-column.svg?style=flat-square)](https://packagist.org/packages/daniel-de-wit/laravel-mysql-move-column)

A Laravel package for simplifying rearranging MySQL database columns.

## Installation

You can install the package via composer:

```bash
composer require daniel-de-wit/laravel-mysql-move-column
```

The package is loaded using [Package Discovery](https://laravel.com/docs/8.x/packages#package-discovery), when disabled read [Manual Installation](#manual-installation).

## Usage

The method `moveColumn` is made available for moving a MySQl column to a new position. 

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->moveColumn('name', 'id');
        });
    }
};
```

## Manual Installation

When disabled, register the LaravelMySQLMoveColumnServiceProvider manually by adding it to your config/app.php

```php
/*
 * Package Service Providers...
 */
 DanielDeWit\LaravelMySQLMoveColumnServiceProvider\Providers\LaravelMySQLMoveColumnServiceProvider::class,
```

## Testing

```bash
composer test
```

## Credits

- [Daniel de Wit](https://github.com/daniel-de-wit)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
