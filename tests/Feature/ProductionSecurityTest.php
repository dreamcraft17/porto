<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductionSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_registration_is_disabled(): void
    {
        $this->assertFalse(config('app.allow_admin_registration'));
    }

    public function test_contact_mail_config_uses_env(): void
    {
        $this->assertNotEmpty(config('mail.contact.to'));
        $this->assertNotEmpty(config('mail.from.address'));
    }

    public function test_security_headers_are_present_on_home(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertSee('Skip to main content', false);
        $response->assertDontSee('dreamcraft17', false);
    }
}
