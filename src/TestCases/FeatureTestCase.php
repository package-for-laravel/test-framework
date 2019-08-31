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

    /**
     * Verify this url requires a login redirect if non auth
     * @param string $url the url to surf to
     * @param string $method the type of request, default GET
     * @param string $redirectTo the url it should redirect to (by default, route('login'))
     */
    protected function noAuthRedirectTest(string $url, string $method = 'GET', string $redirectTo = null): void
    {
        $redirectTo = $redirectTo ?? route('login');
        $this->call($method, $url)->assertStatus(302)->assertRedirect($redirectTo);
    }
}
