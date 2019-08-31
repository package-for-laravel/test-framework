<?php
declare(strict_types=1);

namespace PackageForLaravel\TestingFramework\TestCases;

use PackageForLaravel\TestingFramework\Concerns\AlertsUnwantedDBAccess;
use PackageForLaravel\TestingFramework\Concerns\HasTodo;
use Tests\TestCase;

/**
 * Class UnitTestCase
 * @package PackageForLaravel\TestingFramework\TestCases
 */
abstract class UnitTestCase extends TestCase
{
    use AlertsUnwantedDBAccess, HasTodo;

    /**
     * Set up the unwanted db access exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->alertUnwantedDBAccess();
    }
}
