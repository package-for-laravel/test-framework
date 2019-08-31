<?php
declare(strict_types=1);

namespace PackageForLaravel\TestingFramework\TestCases;

use PackageForLaravel\TestingFramework\Concerns\CreatingActingAs;

/**
 * Class FeatureTestCase
 * @package PackageForLaravel\TestingFramework\TestCases
 */
class FeatureTestCase extends IntegrationTestCase
{
    use CreatingActingAs;
}
