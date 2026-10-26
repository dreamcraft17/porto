<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioPublicLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_uses_portfolio_shell_without_legacy_navbar(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('site-headbar', false);
        $response->assertSee('intro-title', false);
        $response->assertSee('I build software that keeps real teams moving.', false);
        $response->assertDontSee('navbar-bold', false);
        $response->assertDontSee('footer-bold', false);
        $response->assertDontSee('bootstrap@5.3.0', false);
    }

    public function test_project_archive_uses_unified_header(): void
    {
        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('site-headbar', false);
        $response->assertSee('Systems shipped for teams and clients.', false);
        $response->assertDontSee('navbar-bold', false);
    }

    public function test_not_found_page_uses_editorial_tokens(): void
    {
        $response = $this->get('/this-route-should-not-exist-porto-test');

        $response->assertNotFound();
        $response->assertSee('404', false);
        $response->assertSee('Kembali ke portfolio', false);
        $response->assertDontSee('#8b5cf6', false);
    }
}
