<?php

namespace Tests\Feature;

use Tests\TestCase;

class ErrorHandlingTest extends TestCase
{
    public function test_invalid_route_returns_404(): void
    {
        $response = $this->get('/nonexistent-page-12345');

        $response->assertStatus(404);
    }

    public function test_404_view_is_rendered(): void
    {
        $response = $this->get('/invalid-url');

        $response->assertViewIs('errors.404');
    }

    public function test_404_page_has_home_link(): void
    {
        $response = $this->get('/invalid-url');

        $response->assertSee('Back to Home', false);
        $response->assertSee(url('/'), false);
    }
}
