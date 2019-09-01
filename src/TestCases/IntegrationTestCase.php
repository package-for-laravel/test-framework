<?php
declare(strict_types=1);

namespace PackageForLaravel\TestingFramework\TestCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PackageForLaravel\TestingFramework\Concerns\HasTodo;
use Tests\TestCase;

/**
 * Class IntegrationTestCase
 * @package PackageForLaravel\TestingFramework\TestCases
 */
abstract class IntegrationTestCase extends TestCase
{
    use RefreshDatabase, HasTodo;

    /**
     * Runs seeders
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
}
