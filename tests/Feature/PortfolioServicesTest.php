<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioServicesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_active_services(): void
    {
        Service::create([
            'title' => 'Custom Web Apps',
            'description' => 'Tailored Laravel applications.',
            'icon' => 'fa-code',
            'order' => 1,
            'active' => true,
        ]);

        Service::create([
            'title' => 'Hidden Service',
            'description' => 'Should not appear.',
            'icon' => 'fa-eye-slash',
            'order' => 2,
            'active' => false,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Custom Web Apps', false);
        $response->assertDontSee('Hidden Service', false);
    }
}
