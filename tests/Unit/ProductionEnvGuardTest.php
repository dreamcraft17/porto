<?php

namespace Tests\Unit;

use App\Support\ProductionEnvGuard;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ProductionEnvGuardTest extends TestCase
{
    public function test_non_production_is_a_noop(): void
    {
        $this->expectNotToPerformAssertions();

        ProductionEnvGuard::assert([
            'env' => 'local',
            'debug' => true,
            'allow_admin_registration' => true,
            'contact_to' => null,
        ]);
    }

    public function test_production_requires_contact_recipient(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('CONTACT_MAIL_TO');

        ProductionEnvGuard::assert([
            'env' => 'production',
            'debug' => false,
            'allow_admin_registration' => false,
            'contact_to' => '',
        ]);
    }

    public function test_production_rejects_debug_and_open_registration(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('APP_DEBUG');

        ProductionEnvGuard::assert([
            'env' => 'production',
            'debug' => true,
            'allow_admin_registration' => false,
            'contact_to' => 'ops@example.com',
        ]);
    }
}
