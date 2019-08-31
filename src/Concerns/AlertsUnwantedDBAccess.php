<?php
/**
 * This trait adds a listener to the DB connection that let's us know when we've accessed the DB accidentally
 */
declare(strict_types=1);

namespace PackageForLaravel\TestingFramework\Concerns;

use Illuminate\Support\Facades\DB;
use PackageForLaravel\TestingFramework\Exceptions\DatabaseAccessException;

/**
 * Trait AlertsUnwantedDBAccess
 * @package PackageForLaravel\TestingFramework\Concerns
 */
trait AlertsUnwantedDBAccess
{
    /**
     * Registers the database listener to throw an exception
     */
    protected function alertUnwantedDBAccess(): void
    {
        DB::listen(function ($query) {
            throw new DatabaseAccessException($query->sql);
        });
    }
}
