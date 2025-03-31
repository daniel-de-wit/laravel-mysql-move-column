<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelMySQLMoveColumnServiceProvider\Tests\Integration;

use DanielDeWit\LaravelMySQLMoveColumnServiceProvider\Providers\LaravelMySQLMoveColumnServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LaravelMySQLMoveColumnServiceProviderTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelMySQLMoveColumnServiceProvider::class,
        ];
    }

    #[Test]
    public function it_auto_registers_the_macro(): void
    {
        $this->assertTrue(Blueprint::hasMacro('moveColumn'));
    }
}
