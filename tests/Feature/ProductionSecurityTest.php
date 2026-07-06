<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductionSecurityTest extends TestCase
{
    public function test_default_registration_is_disabled(): void
    {
        $this->assertFalse(config('app.allow_admin_registration'));
    }

    public function test_contact_mail_config_uses_env(): void
    {
        $this->assertNotEmpty(config('mail.contact.to'));
        $this->assertNotEmpty(config('mail.from.address'));
    }
}
