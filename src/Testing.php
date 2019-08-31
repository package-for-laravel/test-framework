<?php
/**
 * Static methods to register certain functionality
 */
declare(strict_types=1);

namespace PackageForLaravel\TestingFramework;

/**
 * Class Testing
 * @package PackageForLaravel\TestingFramework
 */
class Testing
{
    /**
     * This registers global deep inspection
     */
    public static function globalInspection(): void
    {
        require_once __DIR__ . '/Concerns/DeepInspection.php';
    }
}
