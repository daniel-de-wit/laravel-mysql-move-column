<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelMySQLMoveColumnServiceProvider\Providers;

use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class LaravelMySQLMoveColumnServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerMoveColumnMacro();
    }

    protected function registerMoveColumnMacro(): void
    {
        Blueprint::macro('moveColumn', function (string $column, string $after): void {
            /** @var Blueprint $this */
            if (DB::connection()->getDriverName() !== 'mysql') {
                throw new RuntimeException('This operation requires a MySQL database driver.');
            }

            $tableName = $this->getTable();

            /**
             * @var null|object{type: string, nullable: "YES"|"NO", default_value: null|string, EXTRA: string} $columnInfo
             */
            $columnInfo = DB::selectOne('
                SELECT COLUMN_TYPE AS type,
                       IS_NULLABLE AS nullable,
                       COLUMN_DEFAULT AS default_value,
                       EXTRA
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_NAME = ?
                  AND COLUMN_NAME = ?
                  AND TABLE_SCHEMA = DATABASE()
            ', [$tableName, $column]);

            if (! $columnInfo) {
                throw new Exception(sprintf('Column %s does not exist in table %s.', $column, $tableName));
            }

            $nullState    = $columnInfo->nullable === 'NO' ? 'NOT NULL' : 'NULL';
            $defaultValue = is_null($columnInfo->default_value) ? '' : 'DEFAULT '.DB::getPdo()->quote($columnInfo->default_value);
            $extra        = $columnInfo->EXTRA ?: '';

            $alterQuery = "
                ALTER TABLE {$tableName}
                MODIFY COLUMN {$column} {$columnInfo->type} {$nullState} {$defaultValue} {$extra}
                AFTER {$after}
            ";

            DB::statement($alterQuery);
        });
    }
}
